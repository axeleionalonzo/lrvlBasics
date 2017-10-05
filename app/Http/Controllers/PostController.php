<?php

namespace App\Http\Controllers;

use App\Post; // links the model post class
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function getIndex(Store $session) {
    	
    	// instantiate post model
    	$post = new Post();
    	$posts = $post->getPosts($session);
    	return view('blog.index', ['posts' => $posts]);
    }
}
