<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\NewPostEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function search($term)
    {
        $posts = Post::search($term)->get();
        $posts->load('user:id,username,avatar');

        return $posts;
    }

    public function showPostForm()
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

        Mail::to('test@google.com')->send(new NewPostEmail([
            'name' => auth()->user()->username,
            'title' => $newPost->title,
        ]));

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created.');
    }

    public function viewSinglePost(Post $post)
    {
        $post->content = strip_tags(
            Str::markdown($post->content),
            '<p><a><ul><ol><li><strong><em><h1><h2><h3><br><hr>'
        );
        return view('single-post', ['post' => $post]);
    }

    public function editPostForm(Post $post)
    {
        return view('edit-post', ['post' => $post]);
    }

    public function submitEditPost(Post $post, Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);

        $post->update($incomingFields);

        return redirect("/post/{$post->id}")->with('success', 'Post successfully updated.');
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect("/profile/{$post->user->username}")->with('success', 'Post successfully deleted.');
    }
}
