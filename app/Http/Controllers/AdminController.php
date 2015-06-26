<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator, Input, Auth, Redirect, Str;
use App\Post;
use App\Blog;

class AdminController extends Controller {

	//get login page

	public function getLogin()
	{
		return view('admin.login');
	}

	//logging in the user with validation

	public function postLogin(){
		$validator = Validator::make(Input::all(), array(
			'username' => 'required',
			'password' => 'required'
		));

		if($validator->fails()){
			return Redirect::route('getLogin')->withErrors($validator)->withInput();
		}else{
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			));

			return Redirect::route('home')->with('success', 'You are logged in');
			}
	}

	//getting the view of admin dashboard

	public function getAdminDash()
	{
		$blogs = Blog::all();

		return view('admin.dash')->with('blogs', $blogs);
	}

	//logging out the user(admin)

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home')->with('success', 'You have logged out!');
	}
}
