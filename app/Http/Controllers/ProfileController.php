<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
{

    $user = $request->user();
    $user->description = $request->description ;

    // 1. Fill the standard text data (name, email)
    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // 2. HANDLE IMAGE UPLOAD
    if ($request->hasFile('image')) {
    
        // A. Delete old image if it exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // B. Store new image in 'images_users' folder
        // This returns the path: "images_users/filename.jpg"
        $path = $request->file('image')->store('images_users', 'public');

        // C. Save path to database
        $user->image = $path;
    }


    // 3. Save changes
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
