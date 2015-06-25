<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator, Input, Auth, Redirect, Str;
use App\Post;
use App\Blog;
use App\User;

class BlogsController extends Controller {

	public function index()
	{
      	$user = User::find(Auth::user()->id);
				$blogs = $user->blogs;
				return view('home')->with('blogs', $blogs);
	}

		//generating the unique slugs from the title of the blog

		public function getSlug($title, $model)
		{
			$slug = Str::slug($title);
			$slugCount = count( $model->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

			return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}

		//f
		public function showBlog($slug)
    {
        $blog = Blog::where('slug', '=', $slug)->firstOrFail();

        return view('blogs.show')->with('blog', $blog);
    }

		//saving a new blog

		public function create()
		{
				return view('blogs.new');
		}

		public function store()
		{
			$user = User::find(Auth::user()->id);

			$validator = Validator::make(Input::all(), array(
				'name' => 'required|min:1|max:255',
				'description' => 'required|min:10|max:65000'
			));

			if($validator->fails())
			{
				return Redirect::route('adminDash')->withErrors($validator)->withInput();
			}
			else
			{
				$blog = new Blog;
				$blog->name = Input::get('name');
				$blog->description = Input::get('description');
				$blog->slug = $this->getSlug($blog->name, $blog);

				if($user->blogs()->save($blog))
				{
					return Redirect::route('adminDash')->with('success', 'The blog was saved successfully!');
				}
				else
				{
					return Redirect::route('adminDash')->with('fail','An error occurred while trying to save the blog!');
				}
			}
		}

		//deleting a blog

		public function deleteBlog($id)
		{
			$blog = Blog::find($id);

			if($blog == null)
			{
				return Redirect::route('adminDash')->with('fail', 'No such blog to delete!');
			}
			else
			{
				if($blog->delete())
				{
					return Redirect::route('adminDash')->with('success', 'The blog was deleted successfully!');
				}
				else
				{
					return Redirect::route('adminDash')->with('fail', 'An error occurred while trying to delete the blog!');
				}
			}
		}

		//getting the view for editing the blog

		public function edit($id)
		{
			$blog = Blog::find($id);

			if($blog == null)
			{
				return Redirect::route('adminDash')->with('fail', 'No such blog to edit!');
			}
			else
			{
				return view('admin.edit')->with('blog', $blog);
			}

		}

		//editing the blog

		public function update($id)
		{
			$validator = Validator::make(Input::all(), array(
				'name' => 'required|min:1|max:255',
				'description' => 'required|min:10|max:65000'
			));

			if($validator->fails())
			{
				return Redirect::route('adminDash')->withErrors($validator)->withInput();
			}

			$blog = Blog::find($id);

			if($blog == null)
			{
				return Redirect::route('adminDash')->with('fail', 'No such blog to edit!');
			}
			else
			{
				$blog->title =  Input::get('title');
				$blog->image = Input::get('image');
				$blog->body = Input::get('body');
				$blog->draft = Input::get('draft');
				$blog->slug = Str::slug($blog->title);

				if($blog->save())
				{
					return Redirect::route('adminDash')->with('success', 'The blog was updated successfully!');
				}
				else
				{
					return Redirect::route('adminDash')->with('fail', 'An error occurred while trying to update the blog!');
				}
			}
		}

}
