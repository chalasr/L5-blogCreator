<?php namespace App\Http\Controllers;

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

	//generating the unique slugs from the title of the post

	public function getSlug($title, $model)
	{
		$slug = Str::slug($title);
		$slugCount = count( $model->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
	}

	//saving a new post

	public function storePost()
	{
		$validator = Validator::make(Input::all(), array(
			'title' => 'required|min:3|max:255',
			'image' => 'required',
			'body' => 'required|min:10|max:65000',
			'draft' => 'required'
		));

		if($validator->fails())
		{
			return Redirect::route('adminDash')->withErrors($validator)->withInput();
		}
		else
		{
			$post = new Post;
			$post->title = Input::get('title');
			$post->image = Input::get('image');
			$post->body = Input::get('body');
			$post->draft = Input::get('draft');
			$post->slug = $this->getSlug($post->title, $post);

			if($post->save())
			{
				return Redirect::route('adminDash')->with('success', 'The post was saved successfully!');
			}
			else
			{
				return Redirect::route('adminDash')->with('fail','An error occurred while trying to save the post!');
			}
		}
	}

	//deleting a post

	public function deletePost($id)
	{
		$post = Post::find($id);

		if($post == null)
		{
			return Redirect::route('adminDash')->with('fail', 'No such post to delete!');
		}
		else
		{
			if($post->delete())
			{
				return Redirect::route('adminDash')->with('success', 'The post was deleted successfully!');	
			}
			else
			{
				return Redirect::route('adminDash')->with('fail', 'An error occurred while trying to delete the post!');
			}
		}
	}

	//getting the view for editing the post

	public function getEditPost($id)
	{
		$post = Post::find($id);

		if($post == null)
		{
			return Redirect::route('adminDash')->with('fail', 'No such post to edit!');
		}
		else
		{
			return view('admin.edit-post')->with('post', $post);
		}

	}

	//editing the post

	public function editPost($id)
	{
		$validator = Validator::make(Input::all(), array(
			'title' => 'required|min:3|max:255',
			'image' => 'required',
			'body' => 'required|min:10|max:65000',
			'draft' => 'required'
		));

		if($validator->fails())
		{
			return Redirect::route('adminDash')->withErrors($validator)->withInput();
		}

		$post = Post::find($id);

		if($post == null)
		{
			return Redirect::route('adminDash')->with('fail', 'No such post to edit!');
		}
		else
		{
			$post->title =  Input::get('title');
			$post->image = Input::get('image');
			$post->body = Input::get('body');
			$post->draft = Input::get('draft');
			$post->slug = Str::slug($post->title);

			if($post->save())
			{
				return Redirect::route('adminDash')->with('success', 'The post was updated successfully!');	
			}
			else
			{
				return Redirect::route('adminDash')->with('fail', 'An error occurred while trying to update the post!');
			}
		}
	}

	//logging out the user(admin)

	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home')->with('success', 'You have logged out!');
	}
}
