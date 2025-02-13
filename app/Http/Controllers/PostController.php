<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
     // Display all posts
     public function index()
     {
         $posts = Post::all();
         return view('posts.index', compact('posts'));
     }
 
     // Show the form to create a new post
     public function create()
     {
         return view('posts.create');
     }
 
     // Store the new post in the database
     public function store(Request $request)
     {
    
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2050',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

          // Image upload
            if ($request->hasFile('image')) {
                $imagePath =$request->file('image')->store('images', 'public');
                $post->image = basename($imagePath); // Save the filename
            }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
     }

    // Show a specific post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    
     // Show the form to edit an existing post
     public function edit(Post $post)
     {
         return view('posts.edit', compact('post'));
     }
 
     // Update the post in the database
     public function update(Request $request, Post $post)
     {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        // Image upload
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if (File::exists(storage_path('app/public/images/' . $post->image))) {
                File::delete(storage_path('app/public/images/' . $post->image));
            }
            if ($request->hasFile('image')) {
                $imagePath =$request->file('image')->store('images', 'public');
                $post->image = basename($imagePath); // Save the filename
            }
            $imagePath =$request->file('image')->store('images', 'public');
            $post->image = basename($imagePath); // Save the new image filename
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
     }
 
     // Delete the post from the database
     public function destroy(Post $post)
     {
        if (File::exists(storage_path('app/public/images/' . $post->image))) {
            File::delete(storage_path('app/public/images/' . $post->image));
        }

        $post->delete();

         return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
     }
}
