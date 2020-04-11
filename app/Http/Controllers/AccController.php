<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Branch;
use App\UserActivity;

class AccController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master')->only('master_update');
	}

    public function edit()
    {
    	$user = auth()->user();
		return view('app.acc.edit', compact('user'));
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

	public function master_update(Request $request)
	{
		$request->validate([
			'branch_id' => 'required|exists:branches,id',
			'pwd' => 'required|string|min:4',
		]);
		$branch = Branch::find($request->branch_id);
		$user = $branch->user;
		if (!$user) {
			return back()->withError('Database Error!');
		}else {
			$user->password = bcrypt($request->pwd);
			$user->save();
			return back()->withMessage('رمز عبور شعبه '.$branch->name.' با موفقیت تغییر یافت');
		}
	}
}
