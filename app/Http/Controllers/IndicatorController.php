<?php

namespace App\Http\Controllers;

use App\Indicator;
use App\Category;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{

    public function index()
    {
        $indicators = Indicator::latest()->paginate(25);
        return view('app.indicator.index', compact('indicators'));
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
        ]);
    }
}