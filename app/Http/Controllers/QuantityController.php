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
            $quantity = Quantity::where('target_id', $resource_id)
                ->where('target_type', Resource::class)
                ->where('branch_id', $branch->id)
                ->first();
            if ($quantity) {
                $quantity->update(compact('value'));
            }else {
                Quantity::create([
                    'branch_id' => $branch->id,
                    'target_id' => $resource_id,
                    'target_type' => Resource::class,
                    'value' => $value,
                ]);
            }
        }

        // indicators
        foreach ($request->indicators as $indicator_id => $value) {
            $quantity = Quantity::where('target_id', $indicator_id)
                ->where('target_type', Indicator::class)
                ->where('branch_id', $branch->id)
                ->first();
            if ($quantity) {
                $quantity->update(compact('value'));
            }else {
                Quantity::create([
                    'branch_id' => $branch->id,
                    'target_id' => $indicator_id,
                    'target_type' => Indicator::class,
                    'value' => $value,
                ]);
            }
        }

        // redirection
        return redirect()->route('branch.index')->withMessage( __('SUCCESS') );
    }
}
