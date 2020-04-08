<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\UserActivity;

class AccController extends Controller
{
	public function __construct()
	{
		// all users can edit and update their own credentials
		$this->middleware('auth');
	}

    public function edit()
    {
    	$user = auth()->user();
		return view('dashboard.acc.edit', compact('user'));
    }

	public function update(Request $request)
	{
		$user = auth()->user();

		$request->validate([
			"name" => "required|unique:users,name,$user->id",
			"current_password" => "required",
			"new_password" => "nullable|confirmed|string|min:4",
		]);

		$change = false;
		if (\Hash::check($request->current_password, $user->password)) {
			if ($user->name != $request->name) {
				$user->name = $request->name;
				$change =true;
			}
			if ($request->new_password) {
				$user->password = bcrypt($request->new_password);
				$change =true;
			}
			if ($change) {
				$user->save();
				return redirect('login')->with(\Auth::logout())->withMessage(__('UPDATE_ACC_MESSAGE'));
			}else {
				return back()->withError(__('NO_CHANGES_MADE'));
			}
		}else {
			return back()->withError(__('WRONG_CURRENT_PASSWORD'));
		}
	}
}
