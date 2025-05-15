<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errors = [];
        $attributes = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($attributes)) {
            $errors['login'] = ['Sorry, the username or the password does not match'];
            if (!empty($errors)) {
                return back()
                    ->withErrors($errors)
                    ->withInput();
            }
            
            return redirect('/');
        }

        $request->session()->regenerate();
        $request->session()->put('username', $attributes['username']);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
