@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100">

    <!-- Top Section -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Dashboard
                </h1>
                <p class="text-gray-500 text-sm">
                    Welcome back, {{ auth()->user()->name }} 👋
                </p>
            </div>

            <form method="POST" action="/logout">
                @csrf
                <button 
                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500 text-sm">Total Books</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ \App\Models\Book::count() }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-gray-500 text-sm">Member Since</h3>
                <p class="text-lg font-semibold text-gray-700 mt-2">
                    {{ auth()->user()->created_at->format('M Y') }}
                </p>
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="bg-white p-8 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-6 text-gray-700">
                Quick Actions
            </h2>

            <div class="flex flex-wrap gap-4">

                <a href="/books"
                   class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    Browse Books
                </a>

            </div>
        </div>

    </div>

</div>

@endsection