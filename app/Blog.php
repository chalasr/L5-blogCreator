<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blogs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description'];

	public function user()
	{
			return $this->belongsTo('App\User');
	}

	public function posts()
	{
			return $this->hasMany('App\Post');
	}
}
