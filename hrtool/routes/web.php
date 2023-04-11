<?php

use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('admin.index');


Route::middleware('auth')->group(function () {

    //My Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'addFamilyMembers'])->name('addFamilyMembers');


    //Organizations
    Route::resource('/organizations', OrganizationController::class);
    Route::get('organizations/create/{parent}', [OrganizationController::class, 'create'])->name('organizations.create.child');
    Route::get('organizations/{id}/organization-card', [OrganizationController::class, 'organization_card'])->name('organizations.organization-card');


    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index');
        Route::get('/users/{id}/profile-card', 'profile_card')->name('users.profile-card');
        Route::get('/users/create', 'create')->name('users.create');
        Route::post('/users', 'store')->name('users.store');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit');
        Route::put('/users/{id}', 'update')->name('users.update');
        Route::delete('/users/{id}', 'destroy')->name('users.destroy');
    });

    //Contract
    Route::controller(ContractController::class)->group(function () {
        Route::get('/contracts', 'index')->name('contracts.index');
        Route::get('/users/{id}/contracts', 'profile')->name('contracts.profile');
        Route::get('/users/{id}/contracts/create', 'create')->name('contracts.create');
        Route::post('/contracts', 'store')->name('contracts.store');

        Route::get('/contracts/{id}/edit', 'edit')->name('contracts.edit');
        Route::put('/contracts/{id}', 'update')->name('contracts.update');
        Route::delete('/contracts/{id}', 'destroy')->name('contracts.destroy');
    });

    //Position
    Route::controller(PositionController::class)->group(function () {
        Route::get('/positions', 'index')->name('positions.index');
        Route::get('/positions/create', 'create')->name('positions.create');
        Route::post('/positions', 'store')->name('positions.store');
        Route::get('/positions/{id}/edit', 'edit')->name('positions.edit');
        Route::put('/positions/{id}', 'update')->name('positions.update');
        Route::delete('/positions/{id}', 'destroy')->name('positions.destroy');
        Route::get('/positions/get-by-organization', [PositionController::class, 'getByOrganization'])->name('positions.get-by-organization');
    });
});


require __DIR__ . '/auth.php';
