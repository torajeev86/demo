@extends('layouts.app')

@section('content')
<div class="container">

   @if (session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.transition = 'opacity 0.5s ease';
                    successMessage.style.opacity = 0;
                    setTimeout(function () {
                        successMessage.style.display = 'none';
                    }, 500); // Remove the element after fade out
                }
            }, 3000); // 3000ms = 3 seconds
        });
    </script>
@endif

    <h1>Posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ \Str::limit($post->content, 50) }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ Storage::url('images/' . $post->image) }}" width="100">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection