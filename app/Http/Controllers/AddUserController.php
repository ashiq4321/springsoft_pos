<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class AddUserController extends Controller
{
	public function index()
	{
		return view('admin.users.adduser');
	}
	public function addUser(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:8|confirmed',
			'role' => 'required',
		], [
			'name.required' => 'Enter User Name',
			'email.required' => 'Email Must Be Unique',
			'password.required' => 'Password Must Be 8 digit',
			'role.required' => 'Enter User Role'
		]);

		//return $request->all();
		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role' => $request->role,
			'status' => 0,
		]);
		// //Alert::success('Success', 'User Created Successfully');
		// return redirect('users')->with('add_successs', 'User Add Successfully');
		return redirect()->route('admin.users')->with('add_successs', 'User Add Successfully');
		//return back()->with('success','User Add Successfully');
	}
}