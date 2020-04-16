<?php

namespace App\Http\Controllers;

use App\Indicator;
use App\Category;
use App\Quantity;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

    public function index()
    {
        $categories = Category::all();
        return view('app.category.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category;
        return view('app.category.form', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->category_name,
        ]);

        return redirect()->route('category.index')->withMessage(__('SUCCESS'));
    }

    public function edit(Category $category)
    {
        return view('app.category.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => "required|string|unique:categories,name,$category->id",
        ]);
        $category->update(['name' => $request->category_name]);
        return redirect()->route('category.index')->withMessage(__('SUCCESS'));
    }

    public function destroy(Category $category)
    {
        if ($category->indicators->count()) {
            $indicator_ids = Indicator::where('category_id', $category->id)->pluck('id')->toArray();
            Quantity::whereIn('target_id', $indicator_ids)->where('target_type', Indicator::class)->delete();
            Indicator::whereIn('id', $indicator_ids)->delete();
        }
        $category->delete();
        return redirect()->route('category.index')->withMessage(__('SUCCESS'));
    }
}
