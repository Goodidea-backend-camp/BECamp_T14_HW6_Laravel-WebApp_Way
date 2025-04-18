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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'user' => ['required'],
            'password' => ['required', Password::min(6), 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $errors = [];

        $user = $attributes['user'];
        $existUser = User::where('user', $user)->exists();

        # 確認password和confrim password是否同一個 & 名稱是否有重複使用
        if ($attributes['password'] != $attributes['password_confirmation']) {
            $errors['password'] = ['The confirmation password does not match.'];
        }
        if ($existUser) {
            $errors['user'] = ['User has been registered, try another one.'];
        }

        if (!empty($errors)) {
            return back()
                ->withErrors($errors)
                ->withInput();
        }
        $newUser = User::create(['user' => $user, 'password' => Hash::make($attributes['password'])]);

        Auth::login($newUser);
        $request->session()->regenerate();
        $request->session()->put('user', $user);
        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
