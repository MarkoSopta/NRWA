<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth.basic');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/login', function () {
    return view('login');
})->name('login');



Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    // Ensure both email and password are provided
    if (!($email && $password)) {
        return redirect()->route('login')->with('error', 'Please provide both email and password');
    }

    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        // Authentication passed
        return redirect('/');
    }

    // Authentication failed
    return redirect()->route('login')->with('error', 'Invalid credentials');
})->name('login.submit');

Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('callback/google', [LoginController::class, 'handleGoogleCallback']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');