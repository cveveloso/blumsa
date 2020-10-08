<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\Models\User;

class AccountController extends Controller
{
	public function __construct() {
		$this->middleware('guest')->except(['Logout', 'Register']);
	}

    public function Authenticate(Request $request) {
    	if ($request->method() == 'GET') {	
			return view('Account.Authenticate');
    	}

    	$rules = [
	    	'email' => 'required|email',
	    	'password' => 'required|unique:users,email'
	    ];
	    
	    $validator = Validator::make($request->all(), $rules);
	    
	    if ($validator->fails()) {
	    	return back()
	    		->withErrors($validator)
	    		->withInput($request->except("password"))
	    		->with('message', 'Se ha producido un error')
	    		->with('typemessage', 'danger');
	    }
	    else {
	    	if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
	    		return redirect('/')
	    			->with('message', 'Usuario ingreso con exito')
	    			->with('typemessage', 'success');
	    	}
	    	else {
	    		return back()
	    		->withInput($request->except("password"))
	    		->with('message', 'Error en usuario y/o password')
	    		->with('typemessage', 'danger');
	    	}
		}
    }

    public function Register(Request $request) {    
    	if ($request->method() == 'GET') {	
			return view('Account.Register');
    	}
    	
	    $rules = [
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	    	'email' => 'required|email|unique:users,email',
	    	'password' => 'required|min:8',
	    	'cpassword' => 'required|same:password'
	    ];
	    
	    $validator = Validator::make($request->all(), $rules);
	    
	    if ($validator->fails()) {
	    	return back()
	    		->withInput($request->except('password', 'cpassword'))
	    		->withErrors($validator)
	    		->with('message', 'Se ha producido un error')
	    		->with('typemessage', 'danger');
	    }
	    else {
	    	$user = new User;
	    	$user->firstname = e($request->input('firstname'));
	    	$user->lastname = e($request->input('lastname'));
	    	$user->email = e($request->input('email'));
	    	$user->password = Hash::make(e($request->input('password')));

	    	if($user->save()){
	    		return redirect('/account/register')
	    			->with('message', 'Usuario registrado con exito')
	    			->with('typemessage', 'success');
	    	}
		}
    }

    public function ForgotPassword() {
    	return view('Account.ForgotPassword');
    }

    public function Logout() {
    	Auth::Logout();
    	return redirect('/account/authenticate');
    }
}
