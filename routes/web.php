<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/store',[MemberController::class, 'store'])->name('member.store');
Route::get('/search',[SearchController::class, 'index'])->name('search');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard',[AdminController::class, 'index'])->name('dashboard');

    Route::get('/members', [MemberController::class, 'index'])->name('admin.member.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('/members', [MemberController::class, 'store'])->name('member.store');
    Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::patch('/members/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
