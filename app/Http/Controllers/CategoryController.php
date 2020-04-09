<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();
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
        $category->delete();
        return redirect()->route('category.index')->withMessage(__('SUCCESS'));
    }
}
