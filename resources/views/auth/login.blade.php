@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        <form method="POST" action="/login" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input 
                    name="email"
                    type="email"
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input 
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200"
            >
                Login
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Don’t have an account?
            <a href="/register" class="text-indigo-600 hover:underline">
                Register
            </a>
        </p>

        <p class="text-sm text-center mt-4">
            Forget password?
            <a href="/password-reset" class="text-indigo-600 hover:underline">
                Click here to reset
            </a>
        </p>

    </div>
</div>
@endsection