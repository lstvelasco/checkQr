<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    // Show login
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Attempt to login
        if(! Auth::attempt($attributes))
        {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        // Regenerate the session token
        request()->session()->regenerate();

        $loginActivity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'logged in',
            'notify' => false,
            'receiver_id'=> Auth::id()
        ]);

        // Redirect
        return redirect('/')->with('toast_success', 'Logged in successfully.');
    }

    public function destroy()
    {
        $loginActivity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'logged out',
            'notify' => false,
            'receiver_id'=> Auth::id()
        ]);

        Auth::logout();

        return redirect('/login');
    }
}
