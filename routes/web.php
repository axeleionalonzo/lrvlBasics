<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// more compact and structured way to link controller
Route::get('/', [
	'uses' => 'PostController@index',
	'as' => 'blog.index'
]);

Route::get('post/{id}', function($id) {
	if ($id == 1) {
		$post = [
			'title' => 'Learning Laravel',
			'content' => 'This blog post will get you right on track with laravel!'
		];
	} else {
		$post = [
			'title' => 'Something else',
			'content' => 'Some other content'
		];
	}
	return view('blog.post', ['post' => $post]);
})->name('blog.post');

Route::get('about', function() {
	return view('other.about');
})->name('other.about');

// admin routes
// grouping routes
Route::group(['prefix' => 'admin'], function() {
	Route::get('', function() {
		return view('admin.index');
	})->name('admin.index');

	Route::get('create', function() {
		return view('admin.create');
	})->name('admin.create');

	// best practice to use laravel dependency injection (e.g. Request $request) if possible
	// you can also use class (e.g. \Illuminate\Http\Request $request) to access Request service 
	// than using facades (e.g. Request::)
	Route::post('create', function(\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
		$validation = $validator->make($request->all(), [
			'title' => 'required|min:5',
			'content' => 'required|min:10'
		]);
		if ($validation->fails()) {
			return redirect()
				->back() // redirect user back to where he is coming from (the form page)
				->withErrors($validation); // flash error data into the session
		}
		return redirect()
			->route('admin.index')
			->with('info', 'Post created, Title: ' . $request->input('title'));
	})->name('create');

	Route::get('edit/{id}', function($id) {
		if ($id == 1) {
			$post = [
				'title' => 'Learning Laravel',
				'content' => 'This blog post will get you right on track with laravel!'
			];
		} else {
			$post = [
				'title' => 'Something else',
				'content' => 'Some other content'
			];
		}
	return view('admin.edit', ['post' => $post]);
	})->name('admin.edit');

	Route::post('edit', function(\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
		$validation = $validator->make($request->all(), [
			'title' => 'required|min:5',
			'content' => 'required|min:10'
		]);
		if ($validation->fails()) {
			return redirect()
				->back() // redirect user back to where he is coming from (the form page)
				->withErrors($validation); // flash error data into the session
		}
		return redirect() // facade form -> Response::redirect()
			->route('admin.index')
			// with method allows us to attach something to our session (store data in between request)
			// access request object that has the input name 'title'
			->with('info', 'Post edited, new Title: ' . $request->input('title'));
	})->name('admin.update');
});