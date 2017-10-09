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

	public function getPosts($session) {

		if (!$session->has('posts')) {
			$this->createDummyData($session);
		}
		return $session->get('posts');
	}

	public function getPost($session, $id) {

		if (!$session->has('posts')) {
			$this->createDummyData($session);
		}
		return $session->get('posts')[$id];
	}

	public function addPost($session, $title, $content) {

		if (!$session->has('posts')) {
			$this->createDummyData($session);
		}
		$posts = $session->get('posts');
		array_push($posts, ['title' => $title, 'content' => $content]);
		$session->put('posts', $posts);
	}

	public function editPost($session, $id, $title, $content) {

		$posts = $session->get('posts');
		$posts[$id] = ['title' => $title, 'content' => $content];
		$session->put('posts', $posts);
	}

	private function createDummyData($session) {

		$posts = [
			[
				'title' => 'Learning Laravel',
				'content' => 'This blog post will get you right on track with laravel!'
			],
			[
				'title' => 'The next Steps',
				'content' => 'Understanding the Basics is great, but you need to be able to make the next steps.'
			],
			[
				'title' => 'Laravel 5.3',
				'content' => 'Though announced as a "minor release", Laravel 5.3 ships with somer very interesting additions and features.'
			]
		];
		$session->put('posts', $posts);
	}

}