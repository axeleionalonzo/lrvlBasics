<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	// defining one-to-many relationships
	public function post() {
		return $this->belongsTo('App\Post', 'post_id'); // post_id will be the foreign key you can modify if u like (this is laravel default, no need to add)
	}
}
