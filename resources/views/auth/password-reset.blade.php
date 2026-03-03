@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold text-center mb-2">
            Reset Password
        </h2>

        <p class="text-sm text-gray-500 text-center mb-6">
            Enter your email and we'll send you a password reset link.
        </p>

        <!-- Success Message -->
        @if(session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="/password-reset" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>

                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('email') border-red-500 @enderror"
                >

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200"
            >
                Send Reset Link
            </button>

        </form>

        <p class="text-sm text-center mt-6">
            Remember your password?
            <a href="/login" class="text-indigo-600 hover:underline">
                Back to Login
            </a>
        </p>

    </div>
</div>

@endsection