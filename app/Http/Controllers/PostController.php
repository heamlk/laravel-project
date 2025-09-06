<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPostForm()
    {
        return view('create-post');
    }

    public function submitNewPost(Request $request)
    {
        // Validate and save the new post
        $incomingFields = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created.');
    }

    public function viewSinglePost(Post $post)
    {
        return view('single-post', ['post' => $post]);
    }
}
