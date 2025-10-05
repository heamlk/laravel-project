<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', 'alpha_dash', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:50', 'confirmed'],
        ]);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account. You are now logged in.');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginUserName' => ['required'],
            'loginPassword' => ['required'],
        ]);

        if (auth()->attempt([
            'username' => $incomingFields['loginUserName'],
            'password' => $incomingFields['loginPassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in.');
        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }

    private function getProfileSharedData(User $user)
    {
        View::share('profileSharedData', [
            'currentlyFollowing' => $user->isFollowedBy(auth()->user()),
            'user' => $user,
            'postCount' => $user->posts->count(),
            'followerCount' => $user->followers()->count(),
            'followingCount' => $user->following()->count(),
        ]);
    }

    public function userProfile(User $user)
    {
        $this->getProfileSharedData($user);

        return view('profile-posts', [
            'posts' => $user->posts()->latest()->get(),
        ]);
    }

    public function userProfileFollowers(User $user)
    {
        $this->getProfileSharedData($user);

        return view('profile-followers', [
            'followers' => $user->followers()->latest()->get(),
        ]);
    }

    public function userProfileFollowing(User $user)
    {
        $this->getProfileSharedData($user);

        return view('profile-following', [
            'following' => $user->following()->latest()->get(),
        ]);
    }

    public function showAvatarForm()
    {
        return view('avatar-form');
    }

    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2000'
        ]);

        $user = auth()->user();

        $fileName = $user->id . '-' . uniqid() . '.jpg';

        $oldAvatar = $user->avatar;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));
        $imageData = $image->cover(120, 120)->toJpeg(90);

        Storage::disk('public')->put('avatars/' . $fileName, $imageData);

        $user->avatar = 'avatars/' . $fileName;
        $user->save();

        if ($oldAvatar != 'images/default-avatar.jpg') {
            Storage::disk('public')->delete(str_replace("storage/", "", $oldAvatar));
        }

        return redirect('/profile/' . $user->username)
            ->with('success', 'Avatar updated successfully.');
    }
}
