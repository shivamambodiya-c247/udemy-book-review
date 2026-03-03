<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {

        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users',

            'password'=>'required|min:6'

        ]);

        $user = User::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make($request->password)

        ]);

        Auth::login($user);

        return redirect('/dashboard');

    }

    public function login(Request $request)
    {

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials))
        {

        $request->session()->regenerate();

            return redirect('/dashboard');

        }

        return back()->withErrors([

            'email'=>'Invalid credentials'

        ]);

    }

    public function dashboard()
    {

        return view('dashboard');

    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }

    public function showResetForm() {
        return view('auth.password-reset');
    }

    public function submitResetForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
    }
}