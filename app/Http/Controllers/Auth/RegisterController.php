<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required'],
            'password' => ['required', Password::min(6), 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $errors = [];

        $user = $attributes['username'];
        $existUser = User::where('username', $user)->exists();

        // 確認password和confrim password是否同一個 & 名稱是否有重複使用
        if ($attributes['password'] != $attributes['password_confirmation']) {
            $errors['password'] = ['The confirmation password does not match.'];
        }
        if ($existUser) {
            $errors['username'] = ['User has been registered, try another one.'];
        }

        if (!empty($errors)) {
            return back()
                ->withErrors($errors)
                ->withInput();
        }
        $newUser = User::create(['username' => $user, 'password' => Hash::make($attributes['password'])]);

        Auth::login($newUser);
        $request->session()->regenerate();
        $request->session()->put('username', $user);
        
        return redirect('/');
    }
}
