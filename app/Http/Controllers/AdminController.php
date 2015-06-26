<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator, Input, Auth, Redirect, Str;
use App\Post;

class AdminController extends Controller {

	//get login page

	public function getLogin()
	{
		return view('admin.login');
	}

	//logging in the user with validation

	public function postLogin()
	{
		$validator = Validator::make(Input::all(), array(
			'username' => 'required',
			'password' => 'required'
		));

		if($validator->fails())
		{
			return Redirect::route('getLogin')->withErrors($validator)->withInput();
		}
		else
		{
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			));

			if($auth)
			{
				return Redirect::route('adminDash');
			}
			else
			{
				return Redirect::route('getLogin')->with('fail','You entered the wrong login credentials!');
			}
		}
	}

	//getting the view of admin dashboard

	public function getAdminDash()
	{
		$posts = Post::all();

		return view('admin.dash')->with('posts', $posts);
	} 

	//logging out the user(admin)

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home')->with('success', 'You have logged out!');
	}
}
