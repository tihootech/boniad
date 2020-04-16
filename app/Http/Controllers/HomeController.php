<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (master()) {
            $branches = Branch::all();
            return view('home', compact('branches'));
        }else {
            $branch = current_branch();
            return view('home', compact('branch'));
        }
    }
}
