<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

    public function landing()
    {
        return view('app.green_management.landing');
    }

    public function index()
    {
        $resources = Resource::all();
        return view('app.green_management.index', compact('resources'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resource_name' => 'required|unique:resources,name',
            'resource_unit' => 'required|string',
        ]);
        Resource::create([
            'name' => $request->resource_name,
            'unit' => $request->resource_unit,
        ]);
        return back()->withMessage(__('SUCCESS'));
    }

    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'name' => 'required|unique:resources,name,'.$resource->id,
            'unit' => 'required|string',
        ]);
        $resource->update([
            'name' => $request->name,
            'unit' => $request->unit,
        ]);
        return back()->withMessage(__('SUCCESS'));
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return back()->withMessage(__('SUCCESS'));
    }
}
