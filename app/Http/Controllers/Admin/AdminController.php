<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;


class AdminController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('validate.admin');
	}

    public function Dashboard() {
    	return view('Admin.Dashboard');
    }
}
