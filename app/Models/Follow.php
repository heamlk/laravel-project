<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function userFollowing()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFollowed()
    {
        return $this->belongsTo(User::class, 'followed_user');
    }
}
