<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        if ($profile->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('profile.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        if ($profile->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        if ($profile->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        $request->validate([
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile->update($request->only('birthday', 'about_me'));

        if ($request->hasFile('avatar')) {
            $profile->avatar = $request->file('avatar')->store('avatars');
            $profile->save();
        }

        return redirect()->route('profile.show', $profile)->with('success', 'Profile updated successfully');
    }
}
