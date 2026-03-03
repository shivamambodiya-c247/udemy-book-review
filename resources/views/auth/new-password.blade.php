@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold text-center mb-2">
            Set New Password
        </h2>

        <p class="text-sm text-gray-500 text-center mb-6">
            Enter your new password below.
        </p>

        <!-- Flash Status -->
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <!-- Hidden Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Hidden Email -->
            <input type="hidden" name="email" value="{{ $email }}">

            <!-- New Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    New Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter new password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('password') border-red-500 @enderror"
                >

                @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm new password"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition duration-200"
            >
                Reset Password
            </button>

        </form>

        <p class="text-sm text-center mt-6">
            Back to
            <a href="/login" class="text-indigo-600 hover:underline">
                Login
            </a>
        </p>

    </div>
</div>

@endsection