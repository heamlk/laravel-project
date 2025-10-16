<?php

namespace App\Livewire;

use App\Models\Follow;
use App\Models\User;
use Livewire\Component;

class AddFollow extends Component
{
    public $username;

    public function save()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $authUserId = auth()->user()->id;
        $followedUserId = User::where('username', $this->username)->first()->id;

        if ($followedUserId == $authUserId) {
            return back()->with('failure', 'You cannot follow yourself.');
        }

        $existCheck = Follow::where([
            ['user_id', '=', $authUserId],
            ['followed_user', '=', $followedUserId]
        ])->count();

        if ($existCheck) {
            return back()->with('failure', 'You are already following that user.');
        }

        $newFollow = new Follow();

        $newFollow->user_id = $authUserId;
        $newFollow->followed_user = $followedUserId;

        $newFollow->save();

        session()->flash('success', 'User successfully followed.');

        return $this->redirect("/profile/{$this->username}", navigate: true);
    }

    public function render()
    {
        return view('livewire.add-follow');
    }
}
