<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Resource;
use App\Category;

class ReportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

    public function report(Request $request)
    {
		$branches = Branch::all();
		$resources = Resource::all();

		$generals = Category::whereType(1)->get();
		$exclusives = Category::whereType(2)->get();

		$request->validate([
			'b' => 'nullable|exists:branches,id',
			'y' => 'nullable|integer|digits:4',
		]);

		$active_branch = Branch::find($request->b);
    	return view('app.report.report', compact('request', 'branches', 'resources', 'active_branch', 'generals', 'exclusives'));
    }
}
