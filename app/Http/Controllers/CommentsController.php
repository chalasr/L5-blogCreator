<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Input, Auth, Redirect, Str;
use App\Post;
use App\Comment;


class CommentsController extends Controller {

	public function create()
    {
        return view('comments.new');
    }

	public function store()
	{
		// $validator = Validator::make(Input::all());

		// if($validator->fails())
		// {
		// 	return Redirect::route('comments.store')->withErrors($validator)->withInput();
		// }
		// else
		// {
			$user = Auth::user()->id;
			$comment = new Comment;
			$comment->content = Input::get('content');
			$comment->user_id = $user;
			$post = Post::find(Input::get('post'));
			$post->comments()->save($comment);
			return Redirect::route('fullPost', $post->slug);
		// 	if($post->save())
		// 	{
		// 		return Redirect::route('adminDash')->with('success', 'The post was saved successfully!');
		// 	}
		// 	else
		// 	{
		// 		return Redirect::route('adminDash')->with('fail','An error occurred while trying to save the post!');
		// 	}
		// }
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

		public function edit($id)
		{
			$post = Post::find($id);

			if($post == null)
			{
				return Redirect::route('adminDash')->with('fail', 'No such post to edit!');
			}
			else
			{
				return view('posts.edit')->with('post', $post);
			}

		}

		//editing the post

		public function update($id)
		{
			$validator = Validator::make(Input::all(), array(
				'title' => 'required|min:3|max:255',
				'image' => 'required',
				'body' => 'required|min:10|max:65000',
				'draft' => 'required'
			));

			if($validator->fails())
			{
				return Redirect::route('posts.edit')->withErrors($validator)->withInput();
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
}
