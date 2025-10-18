<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourcePath = database_path('seeders/avatars');
        // List all image files in this folder
        $imageFiles = File::files($sourcePath);

        if (count($imageFiles) > 0) {
            // Choose a random image file
            $randomImage = $imageFiles[array_rand($imageFiles)];

            // Create a unique file name
            $fileName = uniqid() . '.jpg';

            // Define the path that will be saved in the database
            $avatarPath = 'avatars/' . $fileName;

            // Create the image manager
            $manager = new ImageManager(new Driver());

            // Read the example image
            $image = $manager->read($randomImage->getRealPath());

            // Resize (cover) and convert to Jpeg with 90% quality
            $imageData = $image->cover(120, 120)->toJpeg(90);

            // Copy the file to the public/storage/avatars folder
            Storage::disk('public')->put($avatarPath, $imageData);
        }

        return [
            'username' => fake()->unique()->userName(),
            'avatar' => $avatarPath ?? null,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
