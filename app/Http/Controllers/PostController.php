<?php

namespace App\Http\Controllers;

use App\Post; // links the model post class
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Session\Store;

class PostController extends Controller
{
    public function getIndex() {
    	
        $posts = Post::all();
    	return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex() {
    	
        $posts = Post::all();
    	return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id) {
    	
        $post = Post::find($id);
    	return view('blog.post', ['post' => $post]);
    }

    public function getAdminCreate() {

    	return view('admin.create');
    }

    public function getAdminEdit($id) {
    	
        $post = Post::find($id);
    	return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    // whenever user submits button on create post
    public function postAdminCreate(Request $request) {
    	// utility method validate() because of exended controller, no need to inject validator
		$this->validate($request, [
			'title' => 'required|min:5',
			'content' => 'required|min:10'
		]);

        // create new post instance and store from requests
    	$post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $post->save();

    	return redirect()
    			->route('admin.index')
    			->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    // whenever user submits button on create post
    public function postAdminUpdate(Store $session, Request $request) {
    	
		$this->validate($request, [
			'title' => 'required|min:5',
			'content' => 'required|min:10'
		]);

    	$post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save(); // laravel will not create a new one but updates the field

    	return redirect()
    			->route('admin.index')
    			->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

    public function getAdminDelete($id) {

        $post = Post::find($id);
        $post->delete();

        return redirect()
            ->route('admin.index')
            ->with('info', 'Post Deleted!');
    }
}