@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">The beautiful Laravel</p>
        </div>
    </div>
    @foreach($posts as $post)
    <div class="row">
        <div class="col-md-12 text-center">
            {{-- you always access database fields like properties --}}
            <h1 class="post-title">{{ $post->title }}</h1>
            <p style="font-weight: bold">
                @foreach($post->tags as $tag)
                    - {{ $tag->name }} -
                @endforeach
            </p>
            <p>{{ $post->content }}</p>
            <p>
                {{ count($post->likes) }} Likes |
                <a href="{{ route('blog.post', ['id' => $post->id]) }}">Read more...</a>
            </p>
        </div>
    </div>
    <hr>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            {{-- run `php artisan vendor:publish --tag=laravel-pagination` to edit the style of 3rd party package --}}
            {{ $posts->links() }}
        </div>
    </div>
@endsection