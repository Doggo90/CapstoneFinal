<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        // $posts = $user->posts()->paginate(5);
        return view('pages.user-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'phone' => ['required','max:11', 'min:11'],
            'address' => ['max:255'],
            'bio' => ['max:255']
        ]);

        auth()->user()->update([
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'bio' => $request->get('bio'),
        ]);
        return back()->with('success', 'Profile succesfully updated');
    }
}
