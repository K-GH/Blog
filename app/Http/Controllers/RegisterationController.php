<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class RegisterationController extends Controller
{
    

		public function create()
		{
			return view('register');
		}



		public function store(Request $request)
		{
			$user=new User();
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);
			$user->save();



			//add role
			$user->roles()->attach(Role::where('name','user')->first());



			//Login
			auth()->login($user);

			//redirect

			return redirect('/posts');

		}
}
