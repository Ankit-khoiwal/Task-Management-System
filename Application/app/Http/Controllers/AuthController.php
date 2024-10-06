<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        if ($request->method() === 'GET') {
            return view('admin.pages.auth.login');
        } else if ($request->method() === 'POST') {
            $validator = Validator::make($request->all(), [
                'email-username' => 'required',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $loginField = $request->input('email-username');
            $password = $request->input('password');

            $user = filter_var($loginField, FILTER_VALIDATE_EMAIL)
                ? \App\Models\User::where('email', $loginField)->first()
                : \App\Models\User::where('name', $loginField)->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user);

                if ($user->role_id === 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('admin.dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid credentials')->withInput();
            }
        }

        abort(404);
    }


    public function register(Request $request)
    {
        if ($request->method() === 'GET') {
            return view('admin.pages.auth.register');
        } else if ($request->method() === 'POST') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|email',
                'username' => 'required|max:255',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $password = Hash::make($request->password);

            $user = new User();
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = $password;
            $user->role_id = 3;
            $user->save();

            Auth::login($user);

            return redirect()->route('admin.dashboard');
        }

        abort(404);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
