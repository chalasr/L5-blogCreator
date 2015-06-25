<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $fillable = ['description', 'name', 'blog_id', 'slug'];

	public function blog()
	{
			return $this->belongsTo('App\Blog');
	}

}
