<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AnnexController;
use App\Http\Controllers\FamilyMemberController;
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

Route::get('/admin-dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified', 'role:admin_hr|admin_it'])->name('admin.index');

Route::get('/user-dashboard', function () {
    return view('user.index');
})->middleware(['auth', 'verified', 'role:user'])->name('user.index');

Route::get('/homepage', function () {
    return view('homepage');
})->middleware(['auth', 'verified', 'role:user|admin_hr|admin_it'])->name('homepage');



Route::middleware('auth')->group(function () {

    //Roles and Permissions - IT Admin only
    Route::middleware('role:admin_it')->group(function () {
        Route::controller(RoleController::class)->group(function () {

            //Roles
            Route::get('/roles', 'roles')->name('roles.index');
            Route::get('/roles/create', 'create_role')->name('roles.create');
            Route::post('/roles', 'store_role')->name('roles.store');
            Route::get('/roles/{id}/edit', 'edit_role')->name('roles.edit');
            Route::put('/roles/{id}', 'update_role')->name('roles.update');
            Route::delete('/roles/{id}', 'destroy_role')->name('roles.destroy');

            //Permissions
            Route::get('/permissions', 'permissions')->name('permissions.index');
            Route::get('/permissions/create', 'create_permission')->name('permissions.create');
            Route::post('/permissions', 'store_permission')->name('permissions.store');
            Route::get('/permissions/{id}/edit', 'edit_permission')->name('permissions.edit');
            Route::put('/permissions/{id}', 'update_permission')->name('permissions.update');
            Route::delete('/permissions/{id}', 'destroy_permission')->name('permissions.destroy');

            //Add Roles in Permissions
            Route::get('/roles-in-permissions', 'roles_in_permissions_index')->name('roles.permissions.index');
            Route::get('/roles-in-permissions/create', 'roles_in_permissions_create')->name('roles.permissions.create');
            Route::post('/roles-in-permissions', 'roles_in_permissions_store')->name('roles.permissions.store');
            Route::get('/roles-in-permissions/{id}/edit', 'roles_in_permissions_edit')->name('roles.permissions.edit');
            Route::put('/roles-in-permissions/{id}', 'roles_in_permissions_update')->name('roles.permissions.update');
            Route::delete('/roles-in-permissions/{id}', 'roles_in_permissions_destroy')->name('roles.permissions.destroy');
        });

        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin-panel', 'admin_index')->name('admin-panel.index');
        });
    });

    //My Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'addFamilyMembers'])->name('addFamilyMembers');
    Route::post('/profile/family-members/update', [ProfileController::class, 'updateFamilyMembers'])->name('updateFamilyMembers');
    Route::post('/profile/family-members/delete/{id}', [ProfileController::class, 'deleteFamilyMember'])->name('profile.family-members.delete');


    //Organizations
    Route::resource('/organizations', OrganizationController::class)->middleware('role:admin_hr|admin_it');
    Route::get('organizations/create/{parent}', [OrganizationController::class, 'create'])->name('organizations.create.child')->middleware('role:admin_hr|admin_it');
    Route::get('organizations/{id}/organization-card', [OrganizationController::class, 'organization_card'])->name('organizations.organization-card')->middleware('role:admin_hr|admin_it|user');


    //Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users.index')->middleware('role:admin_hr|admin_it|user');
        Route::get('/users/{id}/profile-card', 'profile_card')->name('users.profile-card')->middleware('role:admin_hr');
        Route::get('/users/create', 'create')->name('users.create')->middleware('role:admin_hr');
        Route::post('/users', 'store')->name('users.store')->middleware('role:admin_hr');
        Route::get('/users/{id}/edit', 'edit')->name('users.edit')->middleware('role:admin_hr');
        Route::put('/users/{id}', 'update')->name('users.update')->middleware('role:admin_hr');
        Route::delete('/users/{id}', 'destroy')->name('users.destroy')->middleware('role:admin_hr|admin_it');
    });


    //Contract
    Route::controller(ContractController::class)->group(function () {
        Route::get('/contracts', 'index')->name('contracts.index')->middleware('role:admin_hr|admin_it');
        Route::get('/users/{id}/contracts', 'profile')->name('contracts.profile')->middleware('checkContractProfileAccess');
        Route::get('/users/{id}/contracts/create', 'create')->name('contracts.create')->middleware('role:admin_hr');
        Route::post('/contracts', 'store')->name('contracts.store')->middleware('role:admin_hr');
        Route::delete('/contracts/{id}', 'destroy')->name('contracts.destroy')->middleware('role:admin_hr');

        //Printing
        Route::get('/contracts/{id}/pdf', 'pdf')->name('contracts.pdf')->middleware('role:admin_hr');
        Route::get('/contracts/{id}/obaveštenje-o-mobingu', 'mob')->name('contracts.mob')->middleware('role:admin_hr');
        Route::get('/contracts/{id}/obaveštenje-o-zakonu-o-uzbunjivačima', 'uzb')->name('contracts.uzb')->middleware('role:admin_hr');
        Route::get('/contracts/{id}/zahtev-za-korišćenje-godišnjeg-odmora', 'odm')->name('contracts.odm')->middleware('role:admin_hr');
        Route::get('/contracts/{id}/sporazum-o-poverljivosti', 'nda')->name('contracts.nda')->middleware('role:admin_hr');
        Route::get('/contracts/{id}/revers', 'rev')->name('contracts.rev')->middleware('role:admin_hr');
    });

    //Annexes
    Route::controller(AnnexController::class)->group(function () {

        Route::get('/annexes/{id}', 'create')->name('annexes.create')->middleware('role:admin_hr');
        Route::post('/annexes', 'store')->name('annexes.store')->middleware('role:admin_hr');
        Route::delete('/annexes/{id}', 'destroy')->name('annexes.destroy')->middleware('role:admin_hr');
        Route::get('/annexes/{contract_id}', 'getAnnexesByContract')->name('annexes.getAnnexesByContract')->middleware('role:admin_hr');

        //Printing
        Route::get('/annexes/{id}/annex-pdf/{annex_number}', 'annex_pdf')->name('annexes.annex-pdf')->middleware('role:admin_hr');
        Route::get('/annexes/{id}/notice-pdf', 'notice_pdf')->name('annexes.notice-pdf')->middleware('role:admin_hr');
    });


    //Positions
    Route::controller(PositionController::class)->group(function () {
        Route::get('/positions', 'index')->name('positions.index')->middleware('role:admin_hr');
        Route::get('/positions/create', 'create')->name('positions.create')->middleware('role:admin_hr');
        Route::post('/positions', 'store')->name('positions.store')->middleware('role:admin_hr');
        Route::get('/positions/{id}/edit', 'edit')->name('positions.edit')->middleware('role:admin_hr');
        Route::put('/positions/{id}', 'update')->name('positions.update')->middleware('role:admin_hr');
        Route::delete('/positions/{id}', 'destroy')->name('positions.destroy')->middleware('role:admin_hr');
        Route::get('/positions/get-by-organization', [PositionController::class, 'getByOrganization'])->name('positions.get-by-organization')->middleware('role:admin_hr');
        Route::get('/positions/{id}/position-card', 'position_card')->name('positions.position-card')->middleware('role:admin_hr');
    });


    //Family members
    Route::get('/family-members/{profileId}', [FamilyMemberController::class, 'getFamilyMembers'])->middleware('role:admin_hr');
});


require __DIR__ . '/auth.php';
