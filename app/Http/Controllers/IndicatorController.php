<?php

namespace App\Http\Controllers;

use App\Indicator;
use App\Category;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

    public function index(Request $request)
    {
        $categories = Category::all();
        $indicators = Indicator::query();

        if ($indicator_title = $request->i) {
            $indicators = $indicators->where('title', 'like', "%$indicator_title%");
        }

        if ($cat = $request->cat) {
            $indicators = $indicators->where('category_id', $cat);
        }else {
            $indicators = $indicators->latest();
        }

        $indicators = $indicators->paginate(25);
        return view('app.indicator.index', compact('indicators', 'categories'));
    }

    public function create()
    {
        $indicator = new Indicator;
        $categories = Category::all();
        return view('app.indicator.form', compact('indicator','categories'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        Indicator::create($data);
        return redirect()->route('indicator.index')->withMessage(__('SUCCESS'));
    }

    public function edit(Indicator $indicator)
    {
        $categories = Category::all();
        return view('app.indicator.form', compact('indicator','categories'));
    }

    public function update(Request $request, Indicator $indicator)
    {
        $data = self::validation();
        $indicator->update($data);
        return redirect()->route('indicator.index')->withMessage(__('SUCCESS'));
    }

    public function destroy(Indicator $indicator)
    {
        $indicator->delete();
        return redirect()->route('indicator.index')->withMessage(__('SUCCESS'));
    }

    public static function validation()
    {
        return request()->validate([
            'title' => 'required|string',
            'points' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'document' => 'required|boolean',
        ]);
    }
}
