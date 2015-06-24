<?php namespace App\Http\Controllers;

use App\Post;

class HomeController extends Controller {

	public function index()
	{
        $posts = Post::where('draft', '=', 0)->orderBy('id', 'desc')->paginate(6);
		return view('home')->with('posts', $posts);
	}

}
