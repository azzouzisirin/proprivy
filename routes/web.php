<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\TermsController;
use App\Policies\UserPolicy;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/terms', [TermsController::class, 'show'])->name('terms.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/authorizations', [AuthorizationController::class, 'index'])->name('authorizations.index');
    Route::post('/authorizations', [AuthorizationController::class, 'update'])->name('authorizations.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/manage-users', [UserController::class, 'manageUsers'])->can('manageUsers');

});
Route::middleware(['auth', 'can:manage-users'])->post('/manage-users', [UserController::class, 'manageUsers']);

Route::get('/admin', function () {
    return 'Admin Panel';
})->middleware('role:admin');

Route::get('/owner', function () {
    return 'Owner Panel';
})->middleware('role:owner');

Route::get('/tenant', function () {
    return 'Tenant Panel';
})->middleware('role:tenant');



require __DIR__.'/auth.php';
