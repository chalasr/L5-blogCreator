<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller {

	public function getPosts($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();

        return view('posts.single')->with('post', $post);
    }

}
