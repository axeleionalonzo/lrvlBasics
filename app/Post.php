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
}