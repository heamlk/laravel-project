<?php

namespace App\Livewire;

use Livewire\Component;

class EditPost extends Component
{
    public $post;
    public $title;
    public $content;

    public function mount()
    {
        $this->title = $this->post->title;
        $this->content = $this->post->content;
    }

    public function save()
    {
        $this->authorize('update', $this->post);

        $incomingFields = $this->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);

        $this->post->update($incomingFields);

        session()->flash('success', 'Post successfully updated');

        $id = $this->post->id;

        return $this->redirect("/post/$id/edit", navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
