<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	// defining many-to-many relationships
	public function posts() {
		// return $this->belongsToMany('App\Post', 'post_tag', 'tag_id', 'post_id'); // post_tag is a pivot table, consists all the foreign key (in this case, post_id and tag_id) of both tables
		// or we can use this, because below is a short hand default from above made by laravel
		return $this->belongsToMany('App\Post')
				->withTimeStamps(); // make sure that time in your pivot table is filled out whenever a new relationship entry is created
	}
}
