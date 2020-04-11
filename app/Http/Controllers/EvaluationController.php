<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use App\Answer;
use App\Branch;
use App\Category;
use App\Indicator;

class EvaluationController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master')->only('destroy');
	}

	public function landing()
	{
		return view('app.evaluation.landing');
	}

	public function list()
	{
		$evaluations = Evaluation::query();
		if (!master()) {
			$evaluations = $evaluations->where('branch_id', current_branch('id'));
		}
		$evaluations = $evaluations->latest()->paginate(25);
		return view('app.evaluation.list', compact('evaluations'));
	}

	public function new()
	{
		$branches = Branch::all();
		$col = master() ? 'master_sum' : 'self_sum';
		$unfinished_evaluations = Evaluation::whereNull($col)->get();
		return view('app.evaluation.new', compact('branches', 'unfinished_evaluations'));
	}

	public function show(Evaluation $evaluation)
	{
		// security check
		if (!master() && $evaluation->branch_id != current_branch('id')) {
			abort(404);
		}

		$categories = Category::all();
		return view('app.evaluation.show', compact('evaluation', 'categories'));
	}

	public function store(Request $request)
	{
		$request->validate(['year'=>'required|integer|digits:4']);

		if (master()) {
			$request->validate(['branch_id'=>'required|exists:branches,id']);
			$branch_id = $request->branch_id;
		}else {
			$branch = current_branch();
			if (!$branch) {
				return back()->withError('Not a valid branch');
			}else {
				$branch_id = $branch->id;
			}
		}

		$found = Evaluation::where('branch_id', $branch_id)->where('year', $request->year)->first();
		if ($found) {
			return back()->withError('در این سال برای این شعبه قبلا ارزیابی ایجاد شده است.');
		}

		$evaluation = Evaluation::create([
			'branch_id' => $branch_id,
			'year' => $request->year,
		]);

		return redirect()->route('evaluate', $evaluation->id);
	}

	public function next(Evaluation $evaluation, Category $category, Request $request)
	{
		// security check
		if (!master() && $evaluation->branch_id != current_branch('id')) {
			abort(404);
		}

		// validation
		$request->validate(['answers.*' => 'required|integer']);
		if (count($request->answers) != $category->indicators->count()) {
			return back()->withError('Uknown Error!');
		}

		foreach ($request->answers as $indicator_id => $raw_answer) {

			// check if answer is not greater than maximum and not lower than 0
			$indicator = Indicator::findOrFail($indicator_id);
			if ($raw_answer > $indicator->points || $raw_answer < 0) {
				return back()->withError('Wrong Input!');
			}

			// register or upate answer in database
			$answer = Answer::where('registered_by_master', master())
				->where('evaluation_id', $evaluation->id)
				->where('indicator_id', $indicator_id)->first();
			if ($answer) {
				$answer->update([
					'point' => $raw_answer
				]);
			}else {
				Answer::create([
					'registered_by_master' => master(),
					'evaluation_id' => $evaluation->id,
					'indicator_id' => $indicator_id,
					'point' => $raw_answer,
				]);
			}
		}
		$next = $category->next();

		// check if evaluation record needs to be updated
		$column_to_look_for = master() ? 'master_sum' : 'self_sum';
		if (!$next || $evaluation->$column_to_look_for) {
			$evaluation->$column_to_look_for = Answer::where('registered_by_master', master())->where('evaluation_id', $evaluation->id)->sum('point');
			$evaluation->save();
		}

		if ($next) {
			// go to next category
			return redirect()->route('evaluate', [$evaluation->id, $next]);
		}else {
			// finalize process
			return redirect()->route('eval.list')->withMessage( __('SUCCESS') );
		}
	}

	public function wizard(Evaluation $evaluation, Category $category)
	{
		// security check
		if (!master() && $evaluation->branch_id != current_branch('id')) {
			abort(404);
		}

		// prepare evaluation indicatrs by determining category
		if (!$category->id) {
			$category = Category::first();
		}

		// return view
		return view('app.evaluation.wizard', compact('evaluation', 'category'));
	}

	public function destroy(Evaluation $evaluation)
	{
		Answer::where('evaluation_id', $evaluation->id)->delete();
		$evaluation->delete();
		return back()->withMessa( __('SUCCESS') );
	}
}
