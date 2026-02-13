<?php

use Illuminate\Support\Facades\Route;

Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('home');
})->name('logout');
Route::get('/admin', function () {
    return view('adminpanel');
})->name('admin');

Route::livewire('/', 'pages::public.home')->name('home');
Route::livewire('/login', 'pages::public.login')->name('login');
Route::livewire('/register', 'pages::public.register')->name('register');
Route::livewire('/requestform', 'pages::public.requestform')->name('requestform');
Route::livewire('/donateblood', 'pages::public.donateblood')->name('donateblood');
Route::livewire('/finddoner', 'pages::public.finddoner')->name('finddoner');
Route::livewire('/profile', 'pages::public.profile')->name('profile');
Route::livewire('/team', 'pages::public.team')->name('team');
