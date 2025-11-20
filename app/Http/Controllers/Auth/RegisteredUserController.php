<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
  
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'description' => ['required', 'string'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'description' => $request->description,
        'password' => Hash::make($request->password),
    ];

    
    $imagePath = $request->file("image")->store('images_users', 'public');
        
    $userData['image'] = $imagePath;
   


    $user = User::create($userData);


    event(new Registered($user));
    Auth::login($user);

    if($user->role === 'admin'){
        return redirect()->intended(route('dashboard', absolute: false));
    

    } elseif($user->role==='user'){
        return redirect()->intended(route('/', absolute: false));
    }


}

}
