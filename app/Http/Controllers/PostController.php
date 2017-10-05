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

    public function getAdminIndex(Store $session) {
    	
    	$post = new Post();
    	$posts = $post->getPosts($session);
    	return view('admin.index', ['posts' => $posts]);
    }

    public function getPost(Store $session, $id) {
    	
    	$post = new Post();
    	$posts = $post->getPosts($session, $id);
    	return view('blog.post', ['posts' => $posts]);
    }

    public function getAdminCreate() {

    	return view('admin.create');
    }

    public function getAdminEdit(Store $session, $id) {
    	
    	$post = new Post();
    	$posts = $post->getPosts($session, $id);
    	return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    // whenever user submits button on create post
    public function postAdminCreate(Store $session, Request $request) {
    	
    	$post = new Post();
    	// calls the addPost from post model
    	$post->addPost($session, $request->input('title'), $request->input('content'));
    	return redirect()
    			->route('admin.index')
    			->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    // whenever user submits button on create post
    public function postAdminUpdate(Store $session, Request $request) {
    	
    	$post = new Post();
    	// calls the addPost from post model
    	$post->editPost($session, $request->input('id'), $request->input('title'), $request->input('content'));
    	return redirect()
    			->route('admin.index')
    			->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }
}
