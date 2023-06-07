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

    Route::get('/uzivatelia', [UserController::class, 'index'])->name('users')->middleware('can:adminViewAny,App\Models\User');

    #SKUPINY
    Route::get('/skupiny', [GroupController::class, 'index'])->name('groups')->middleware('can:viewAny,App\Models\Group');
    Route::post('/skupiny', [GroupController::class, 'store'])->name('groups.add')->middleware('can:create,App\Models\Group');
    Route::get('/skupiny/upravit/{group}', [GroupController::class, 'edit'])->name('group.edit')->middleware('can:update,App\Models\Group');
    Route::patch('/skupiny/upravit/{group}', [GroupController::class, 'update'])->middleware('can:update,App\Models\Group');
    Route::delete('/skupiny/vymazat/{group}', [GroupController::class, 'delete'])->name('group.delete')->middleware('can:delete,App\Models\Group');
    
    #SKUPINY - UŽÍVATEĽ
    Route::get('/skupiny/uzivatel/{user}', [GroupController::class, 'user'])->name('groups.user')->middleware('can:setUser,App\Models\Group');
    Route::patch('/skupiny/uzivatel/{user}', [GroupController::class, 'userSetGroup'])->name('groups.user.add')->middleware('can:setUser,App\Models\Group');

    #POVOLENIA - UŹÍVATEĽ
    Route::get('/povolenia/uzivatel/{user}', [PermissionController::class, 'user'])->name('permissions.user')->middleware('can:setUser,App\Models\Permission');
    Route::patch('/povolenia/uzivatel/{user}', [PermissionController::class, 'userSave'])->middleware('can:setUser,App\Models\Permission');
    #POVOLENIA - SKUPINY
    Route::get('/povolenia/skupina/{group}', [PermissionController::class, 'group'])->name('permissions.group')->middleware('can:setGroup,App\Models\Permission');
    Route::patch('/povolenia/skupina/{group}', [PermissionController::class, 'groupSave'])->middleware('can:setGroup,App\Models\Permission');


    #HRAC
    Route::get('/hrac/novy/{user_id?}', [PlayerController::class, 'create'])->name('player.add')->middleware('can:create,App\Models\Player');
    Route::post('/hrac/novy', [PlayerController::class, 'store'])->middleware('can:create,App\Models\Player');


});


Route::get('/hrac/upravit/{player?}', [PlayerController::class, 'edit'])->name('player.edit')->middleware('can:edit,player');
Route::patch('/hrac/upravit/{player?}', [PlayerController::class, 'update'])->middleware('can:edit,player');
Route::delete('/hrac/vymazat/{player?}', [PlayerController::class, 'delete'])->middleware('can:delete,player');
