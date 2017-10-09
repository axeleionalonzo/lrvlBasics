<?php

namespace App;
// extends eloquent model
// php artisan make:model Post -m
// -m creates migration file
use Illuminate\Database\Eloquent\Model;
// does not delete the data in the database, instead giving it a deleted_at value
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
	// make assignable database field 
	protected $fillable = ['title', 'content'];
	protected $dates = ['deleted_at'];

	// defining one-to-many relationships
	public function likes() {
		return $this->hasMany('App\Like', 'post_id'); // post_id will be the foreign key you can modify if u like (this is laravel default, no need to add)
	}
}