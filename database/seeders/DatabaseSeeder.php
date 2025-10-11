<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Step 1: Create 10 users and store them in a collection
        $users = User::factory(10)->create();

        // Step 2: For each of the 10 users, create between 1 and 5 posts
        $users->each(function ($user) {
            Post::factory(rand(1, 5))->create(['user_id' => $user->id]);
        });

        // Step 3: Get users to follow each other
        $users->each(function ($user) use ($users) {
            // Pick 1-3 random users from the collection to follow
            // Ensuring the user doesn't follow themselves
            $usersToFollow = $users->where('id', '!=', $user->id)->random(rand(1, 3));

            foreach ($usersToFollow as $userToFollow) {
                Follow::factory()->create([
                    'user_id' => $user->id,
                    'followed_user' => $userToFollow->id,
                ]);
            }
        });
    }
}
