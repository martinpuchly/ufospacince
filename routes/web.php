<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::name('admin.')->prefix('admin')->group(function () {

    Route::get('/uzivatelia', [UserController::class, 'index'])->name('users')->can('adminViewAny', App\Models\User::class);

    #SKUPINY
    Route::get('/skupiny', [GroupController::class, 'index'])->name('groups')->can('viewAny', App\Models\Group::class);
    Route::post('/skupiny', [GroupController::class, 'store'])->name('groups.add')->can('create', App\Models\Group::class);
    Route::get('/skupiny/upravit/{group}', [GroupController::class, 'edit'])->name('group.edit')->can('update', App\Models\Group::class);
    Route::patch('/skupiny/upravit/{group}', [GroupController::class, 'update'])->can('update', App\Models\Group::class);
    Route::delete('/skupiny/vymazat/{group}', [GroupController::class, 'delete'])->name('group.delete')->can('delete', App\Models\Group::class);
    
    #SKUPINY - UŽÍVATEĽ
    Route::get('/skupiny/uzivatel/{user}', [GroupController::class, 'user'])->name('groups.user')->can('setUser', App\Models\Group::class);
    Route::patch('/skupiny/uzivatel/{user}', [GroupController::class, 'userSetGroup'])->name('groups.user.add')->can('setUser', App\Models\Group::class);

    #POVOLENIA - UŹÍVATEĽ
    Route::get('/povolenia/uzivatel/{user}', [PermissionController::class, 'user'])->name('permissions.user')->can('setUser', App\Models\Permission::class);
    Route::patch('/povolenia/uzivatel/{user}', [PermissionController::class, 'userSave'])->can('setUser', App\Models\Permission::class);
    #POVOLENIA - SKUPINY
    Route::get('/povolenia/skupina/{group}', [PermissionController::class, 'group'])->name('permissions.group')->can('setGroup', App\Models\Permission::class);
    Route::patch('/povolenia/skupina/{group}', [PermissionController::class, 'groupSave'])->can('setGroup', App\Models\Permission::class);


    #HRAC
    Route::get('/hraci', [PlayerController::class, 'adminIndex'])->name('players')->can('adminIndex', App\Models\Player::class);
    Route::get('/hrac/novy/{user?}', [PlayerController::class, 'create'])->name('player.add')->can('create', App\Models\Player::class);
    Route::post('/hrac/novy/{user?}', [PlayerController::class, 'store'])->can('create', App\Models\Player::class);


    #SLIDER
    Route::get('/slides', [SlideController::class, 'create'])->name('slide.add')->can('create', App\Models\Slide::class);
    Route::get('/slide/novy', [SlideController::class, 'create'])->name('slide.add')->can('create', App\Models\Slide::class);
    Route::post('/slide/novy', [SlideController::class, 'store'])->can('create', App\Models\Slide::class);
    Route::get('/slide/upravit/{slide}', [SlideController::class, 'edit'])->name('slide.edit')->can('edit', App\Models\Slide::class);
    Route::patch('/slide/upravit/{slide}', [SlideController::class, 'update'])->can('edit', App\Models\Slide::class);
    Route::delete('/slide/vymazat/{slide}', [SlideController::class, 'delete'])->name('slide.delete')->can('delete', App\Models\Slide::class);



});


Route::get('/hrac/upravit/{player?}', [PlayerController::class, 'edit'])->name('player.edit')->middleware('can:edit,player')->can('edit', $player);
Route::patch('/hrac/upravit/{player?}', [PlayerController::class, 'update'])->middleware('can:edit,player')->can('edit', $player);
Route::delete('/hrac/vymazat/{player?}', [PlayerController::class, 'delete'])->middleware('can:delete,player')->can('delete', $player);
Route::delete('/hrac/destroy/{player?}', [PlayerController::class, 'destroy'])->can('destroy', App\Models\Player::class);
