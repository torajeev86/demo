@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    @if($post->image)
        <img src="{{ Storage::url('images/' . $post->image) }}" width="200px">
    @endif
    <br>
    <br>
    <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
</div>
@endsection