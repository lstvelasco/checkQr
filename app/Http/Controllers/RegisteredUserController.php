<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    // Show Registration
    public function create()
    {
        return view('auth.register');
    }

    // Show Reset Password
    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function store(Request $request)
    {
        // Validation
        $userAttributes = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'student_id' => ['required', 'unique:users,student_id'],
            'section' => ['required'],
            'major' => ['required', Rule::in(['Software Development', 'Networking and Data Security', 'Graphics Design and Animation'])],
            'year' => ['required', Rule::in(['1st Year', '2nd Year', '3rd Year', '4th Year'])], 
            'email' => ['required', 'email', 'unique:users,email'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'birthday' => ['required', 'date'],
            'account_type' => ['required', Rule::in(['Student', 'Faculty', 'Dean', 'Staff'])],
            'password' => ['required', Password::min(6), 'confirmed']
        ]);

        $addressAttributes = $request->validate([
            'street_address' => ['required'],
            'city' => ['required'],
            'barangay' => ['required']
        ]);

        $address = request('street_address') . ', ' .  request('barangay') . ', ' . request('city');

        $attributes = array_merge($userAttributes, ['address' => $address]);


        // Create the user
        $user = User::create($attributes);

        // Login
        Auth::login($user);

        // Create activity
        $registerActivity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'created an account',
            'notify' => false,
            'receiver_id' => Auth::id()
        ]);

        $loginActivity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'logged in',
            'notify' => false,
            'receiver_id' => Auth::id()
        ]);

        // Redirect
        return redirect('/')->with('toast_success', 'Logged in successfully.');
    }

    public function edit()
    {
        $user = User::all();
        $avatar = Avatar::where('isActive', true)->get();
        $notifications = Activity::where('notify', true)->get();

        return view('account-settings.index', compact('avatar', 'user', 'notifications'));
    }

    public function update(User $user)
    {
        // Validation

        // Authorization: Check if the authenticated user is the same as the user being updated
        if ($user->id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $userAttributes = request()->validate([
            'contact_num' => ['nullable', 'min_digits:11'],
            'birthday' => ['nullable', 'date'],
            'email' => ['nullable', 'email', 'unique:users,email'],
            'account_type' => ['nullable', Rule::in(['Dean', 'Faculty', 'Staff', 'Student'])],
            'gender' => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
            'password' => ['required', Password::min(6), 'confirmed']
        ]);

        $avatarAttributes = request()->validate([
            'image_url' => ['nullable', File::image()]
        ]);


        // Update user
        $user->update([
            'first_name' => request('first_name'),
            'middle_name' => request('middle_name'),
            'last_name' => request('last_name'),
            'birthday' => request('birthday'),
            'gender' => request('gender'),
            'contact_num' => request('contact_num'),
            'address' => request('street_address') . ', ' . request('barangay') . ', ' . request('city'),
            'password' => request('password')
        ]);


        // Handle avatar update if there is a file
        if (request()->hasFile('image_url')) {
            // Deactivate all existing avatars for the user
            $user->avatars()->update(['isActive' => false]);

            // Store the new avatar
            $file = $avatarAttributes['image_url'];
            $path = $file->store('avatars/' . $user->id, 'public');

            // Create a new avatar record
            $user->avatars()->create([
                'image_url' => $path,
                'isActive' => true
            ]);
        }

        // Create Activity
        $Activity = Activity::create([
            'author_id' => Auth::id(),
            'action' => 'updated account',
            'notify' => true,
            'receiver_id' => Auth::id()
        ]);

        // Redirect
        return redirect('/account-settings')->with('toast_success', 'Account updated successfully.');
    }
}
