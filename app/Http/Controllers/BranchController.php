<?php

namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index()
    {
        $branches = Branch::latest()->get();
        return view('app.branch.index', compact('branches'));
    }

    public function create()
    {
        $branch = new Branch;
        return view('app.branch.form', compact('branch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|unique:branches,name',
            'username' => 'required|string|unique:users,name|min:4',
            'pwd' => 'required|string|min:4',
        ]);

        $user = User::create([
            'name' => $request->username,
            'password' => bcrypt($request->pwd),
            'type' => 'branch',
        ]);

        Branch::create([
            'user_id' => $user->id,
            'name' => $request->branch_name,
        ]);

        return redirect()->route('branch.index')->withMessage(__('SUCCESS'));
    }

    public function edit(Branch $branch)
    {
        return view('app.branch.form', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_name' => "required|string|unique:branches,name,$branch->id",
        ]);
        $branch->update(['name' => $request->branch_name]);
        return redirect()->route('branch.index')->withMessage(__('SUCCESS'));
    }

    public function destroy(Branch $branch)
    {
        $user = $branch->user;
        $user->delete();
        $branch->delete();
        return redirect()->route('branch.index')->withMessage(__('SUCCESS'));
    }
}
