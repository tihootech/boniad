<?php

namespace App\Http\Controllers;

use App\Quantity;
use App\Branch;
use App\Category;
use App\Resource;
use App\Indicator;
use Illuminate\Http\Request;

class QuantityController extends Controller
{

    public function edit_pattetn($type, $id)
    {
        $categories = Category::all();
        $branches = Branch::all();
        $class = class_name($type);
        $object = $class::findOrFail($id);
        return view('app.quantity.edit_pattern', compact('type', 'id', 'object', 'categories', 'branches'));
    }

    public function update_pattetn($type, $id, Request $request)
    {
        $class = class_name($type);
        if ($request->branches && is_array($request->branches)) {
            foreach ($request->branches as $branch_id => $value) {
                Quantity::createOrUpdate($id, $class, $branch_id, $value);
            }
        }
        return redirect()->route($type.'.index')->withMessage( __('SUCCESS') );
    }

    public function edit(Branch $branch)
    {
        $categories = Category::all();
        $resources = Resource::all();
        return view('app.quantity.edit', compact('branch', 'categories', 'resources'));
    }

    public function update(Branch $branch, Request $request)
    {
        $request->validate([
            'resources.*' => 'integer|min:1',
            'indicators.*' => 'integer|min:1',
        ]);

        // resources
        foreach ($request->resources as $resource_id => $value) {
            Quantity::createOrUpdate($resource_id, Resource::class, $branch->id, $value);
        }

        // indicators
        foreach ($request->indicators as $indicator_id => $value) {
            Quantity::createOrUpdate($indicator_id, Indicator::class, $branch->id, $value);
        }

        // redirection
        return redirect()->route('branch.index')->withMessage( __('SUCCESS') );
    }
}
