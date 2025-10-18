<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Mail\NewPostEmail;
use Illuminate\Support\Facades\Mail;

class CreatePost extends Component
{
    public $title;
    public $content;

    public function create()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        // Validate and save the new post
        $incomingFields = $this->validate([
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

        session()->flash('success', 'New post successfully created.');

        return $this->redirect("/post/{$newPost->id}", navigate: true);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
