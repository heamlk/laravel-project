<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Follow;
use Livewire\Component;

class RemoveFollow extends Component
{
    public $username;

    public function save()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $authUserId = auth()->user()->id;
        $followedUserId = User::where('username', $this->username)->first()->id;

        Follow::where([
            ['user_id', '=', $authUserId],
            ['followed_user', '=', $followedUserId],
        ])->delete();

        session()->flash('success', 'User successfully unfollowed.');

        return $this->redirect("/profile/{$this->username}", navigate: true);
    }

    public function render()
    {
        return view('livewire.remove-follow');
    }
}
