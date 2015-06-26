<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator, Input, Auth, Redirect, Str;
use App\Post;
use App\Blog;
use App\User;


class PostsController extends Controller {

		public function getPost($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        return view('posts.single')->with('post', $post);
    }

		//generating the unique slugs from the title of the post

		public function getSlug($title, $model)
		{
			$slug = Str::slug($title);
			$slugCount = count( $model->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}

		//saving a new post

		public function create()
    {
				$user = User::find(Auth::user()->id);
				if(!$user->blogs->count())
					return Redirect::route('home')->with('fail', 'You must have a blog if you want create posts');

		    return view('posts.new')->with('user', $user);
    }

		public function store()
		{
			$validator = Validator::make(Input::all(), array(
				'title' => 'required|min:3|max:255',
				'body' => 'required|min:10|max:65000',
				'image' => 'required',
				'draft' => 'required',
			));

			if($validator->fails()){
				return Redirect::route('posts.create')->withErrors($validator)->withInput();
			}else{
				$post = new Post;
				$post->title = Input::get('title');
				$post->image = Input::get('image');
				$post->body = Input::get('body');
				$post->draft = Input::get('draft');
				$post->slug = $this->getSlug($post->title, $post);
				$blog = Blog::find(Input::get('blog'));
				$blog->posts()->save($post);

				return Redirect::route('adminDash')->with('success', 'The post was saved successfully!');
			}
		}

		//deleting a post

		public function deletePost($id)
		{
			$post = Post::find($id);

			if($post == null){
				return Redirect::route('adminDash')->with('fail', 'No such post to delete!');
			}else{
				if($post->delete()){
					return Redirect::route('adminDash')->with('success', 'The post was deleted successfully!');
				}else{
					return Redirect::route('adminDash')->with('fail', 'An error occurred while trying to delete the post!');
				}
			}
		}

		//getting the view for editing the post

		public function edit($id)
		{
			$post = Post::find($id);

			if($post == null){
				return Redirect::route('adminDash')->with('fail', 'No such post to edit!');
			}else{
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

			if($post == null){
				return Redirect::route('adminDash')->with('fail', 'No such post to edit!');
			}else{
				$post->title =  Input::get('title');
				$post->image = Input::get('image');
				$post->body = Input::get('body');
				$post->draft = Input::get('draft');
				$post->slug = Str::slug($post->title);

				if($post->save()){
					return Redirect::route('adminDash')->with('success', 'The post was updated successfully!');
				}else{
					return Redirect::route('adminDash')->with('fail', 'An error occurred while trying to update the post!');
				}
			}
		}
}
