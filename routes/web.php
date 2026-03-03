<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

Route::get('/', function () {
    return redirect()->route('books.index');
});


Route::middleware('auth')->group(function () {
    Route::resource('books', controller: BookController::class)
        ->only(['index', 'show']);

    Route::get('/dashboard',[AuthController::class,'dashboard']);

    Route::get('books/{book}/reviews/create', [ReviewController::class, 'create'])
        ->name('books.reviews.create');

    Route::post('books/{book}/reviews', [ReviewController::class, 'store'])
        ->name('books.reviews.store')
        ->middleware('throttle:reviews');

});


// Guest Routes
Route::middleware('guest')->group(function () {

    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login']);

    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/password-reset', [AuthController::class, 'showResetForm']);

    Route::post('/password-reset', [AuthController::class, 'submitResetForm']);
});

Route::post('/logout',[AuthController::class,'logout']);


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.new-password', [
        'token' => $token,
        'email' => request()->email,
    ]);
})->name('password.reset');


Route::post('/reset-password', function (Request $request) {

    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// Route::get('/dashboard',[AuthController::class,'dashboard'])
//         ->middleware('auth');