@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="title" 
                        name="title"
                        value="{{ $post['title'] }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="content" 
                        name="content"
                        value="{{ $post['content'] }}">
                </div>
                {{-- csrf token are used to help protect servers from getting malicious request --}}
                {{-- we can use <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                     or we can use laravel helper function for this! --}}
                {{ csrf_field() }} 
                <input type="hidden" name="id" value="{{ $postId }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection