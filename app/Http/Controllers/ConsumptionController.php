<?php

namespace App\Http\Controllers;

use App\Consumption;
use App\Resource;
use App\Branch;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $consumptions = Consumption::query();
        if (branch()) {
            $branch = Branch::where('user_id', auth()->id())->first();
            if (!$branch) {
                return back()->withError('Not a valid branch');
            }
            $consumptions = $consumptions->where('branch_id', $branch->id);
        }
        $consumptions = $consumptions->latest()->paginate(25);
        return view('app.consumption.index', compact('consumptions'));
    }

    public function create()
    {
        $consumption = new Consumption;
        $resources = Resource::all();
        return view('app.consumption.form', compact('consumption','resources'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        $branch = Branch::where('user_id', auth()->id())->first();
        if (!$branch) {
            return back()->withError('Not a valid branch');
        }
        $data['branch_id'] = $branch->id;
        Consumption::create($data);
        return redirect()->route('consumption.index')->withMessage(__('SUCCESS'));
    }

    public function edit(Consumption $consumption)
    {
        $resources = Resource::all();
        return view('app.consumption.form', compact('consumption','resources'));
    }

    public function update(Request $request, Consumption $consumption)
    {
        $data = self::validation();
        $consumption->update($data);
        return redirect()->route('consumption.index')->withMessage(__('SUCCESS'));
    }

    public function destroy(Consumption $consumption)
    {
        $consumption->delete();
        return redirect()->route('consumption.index')->withMessage(__('SUCCESS'));
    }

    public static function validation()
    {
        return request()->validate([
            'resource_id' => 'required|exists:resources,id',
            'amount' => 'required|integer',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|digits:4',
        ]);
    }
}
