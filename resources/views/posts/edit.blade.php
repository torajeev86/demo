@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required>{{ $post->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image Upload</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-warning mt-3">Update Post</button>
        </form>
    </div>
@endsection