<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user)
    {
        $authUserId = auth()->user()->id;
        $followedUserId = $user->id;

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

        return back()->with('success', 'User successfully followed.');
    }

    public function removeFollow(User $user)
    {
        $authUserId = auth()->user()->id;
        $followedUserId = $user->id;

        Follow::where([
            ['user_id', '=', $authUserId],
            ['followed_user', '=', $followedUserId],
        ])->delete();

        return back()->with('success', 'User successfully unfollowed.');
    }
}
