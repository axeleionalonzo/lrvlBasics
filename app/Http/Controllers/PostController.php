<?php

namespace App\Http\Controllers;

use App\Post; // links the model post class
use App\Like;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostController extends Controller
{
    public function getIndex() {
        $posts = Post::orderBy('created_at', 'desc')->get(); // using query builder
    	return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex() {
        $posts = Post::orderBy('title', 'asc')->get(); // you can chain as many transformation method (e.g. where, join)
    	return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id) {
        // we have to chain the like relation for eager loading
        // tells laravel give me the post and create a join query with all the related likes
        $post = Post::where('id', $id)->with('likes')->first(); // well use first because we know the query is only one
        // $post = Post::find($id); // or we can use find for shorter hand
        return view('blog.post', ['post' => $post]);
    }

    public function getLikePost($id) {
        $post = Post::where('id', $id)->first();
        $like = new Like();
        $post->likes()->save($like); // create a new like by accessing the relation post->likes and store the like
        return redirect()->back(); // return to the last page where we can see the updated like
    }

    public function getAdminCreate() {
        $tags = Tag::all();
    	return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit($id) {
        $post = Post::find($id);
        $tags = Tag::all();
    	return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);
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
        // adds a condition if there is no tag
        $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));

    	return redirect()
    			->route('admin.index')
    			->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    // whenever user submits button on create post
    public function postAdminUpdate(Request $request) {
		$this->validate($request, [
			'title' => 'required|min:5',
			'content' => 'required|min:10'
		]);

    	$post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save(); // laravel will not create a new one but updates the field
        // we can detach first so that we can make sure that the removed tags are no longer attached
        // $post->tags()->detach();
        // $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));
        // or we can use laravel sync() for this to make sure that only the modified tags are updated
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));

    	return redirect()
    			->route('admin.index')
    			->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

    public function getAdminDelete($id) {
        $post = Post::find($id);
        $post->likes()->delete(); // delete the like where points to a post which will no longer exist
        $post->tags()->detach(); // many-to-many relationship use detach as delete
        $post->delete();

        return redirect()
            ->route('admin.index')
            ->with('info', 'Post Deleted!');
    }
}