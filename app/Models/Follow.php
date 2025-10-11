<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;

    public function userFollowing()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userFollowed()
    {
        return $this->belongsTo(User::class, 'followed_user');
    }
}
