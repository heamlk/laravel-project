<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class AvatarUpload extends Component
{
    use WithFileUploads;

    public $avatar;

    public function save()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $user = auth()->user();

        $fileName = $user->id . '-' . uniqid() . '.jpg';

        $oldAvatar = $user->avatar;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->avatar);
        $imageData = $image->cover(120, 120)->toJpeg(90);

        Storage::disk('public')->put('avatars/' . $fileName, $imageData);

        $user->avatar = 'avatars/' . $fileName;
        $user->save();

        if ($oldAvatar != 'images/default-avatar.jpg') {
            Storage::disk('public')->delete(str_replace("storage/", "", $oldAvatar));
        }

        session()->flash('success', 'Avatar updated successfully.');

        return $this->redirect('/manage-avatar', navigate: true);
    }

    public function render()
    {
        return view('livewire.avatar-upload');
    }
}
