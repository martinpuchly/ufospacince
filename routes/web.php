<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
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

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/uzivatelia', [UserController::class, 'index'])->name('users')->middleware('can:adminViewAny,App\Models\User');
    
    
    Route::get('/hraci', [PlayerController::class, 'adminIndex'])->name('players');

    Route::get('/profil/novy/{user}', [PlayerController::class, 'adminCreate'])->name('player.add');
    Route::post('/profil/novy/{user}', [PlayerController::class, 'adminStore']);


    #SKUPINY
    Route::get('/skupiny', [GroupController::class, 'index'])->name('groups')->middleware('can:viewAny,App\Models\Group');
    Route::post('/skupiny', [GroupController::class, 'store'])->name('groups.add')->middleware('can:create,App\Models\Group');
    Route::get('/skupiny/upravit/{group}', [GroupController::class, 'edit'])->name('group.edit')->middleware('can:edit,App\Models\Group');
    Route::patch('/skupiny/upravit/{group}', [GroupController::class, 'update'])->middleware('can:edit,App\Models\Group');
    Route::delete('/skupiny/vymazat/{group}', [GroupController::class, 'delete'])->name('group.delete')->middleware('delete:edit,App\Models\Group');
    
    #SKUPINY - UŽÍVATEĽ
    Route::get('/skupiny/uzivatel/{user}', [GroupController::class, 'user'])->name('groups.user')->middleware('can:setUser,App\Models\Group');
    Route::patch('/skupiny/uzivatel/{user}', [GroupController::class, 'userSetGroup'])->name('groups.user.add')->middleware('can:setUser,App\Models\Group');

    #POVOLENIA - UŹÍVATEĽ
    Route::get('/povolenia/uzivatel/{user}', [PermissionController::class, 'user'])->name('permissions.user')->middleware('can:setUser,App\Models\Permission');
    Route::patch('/povolenia/uzivatel/{user}', [PermissionController::class, 'userSave'])->middleware('can:setUser,App\Models\Permission');
    #POVOLENIA - SKUPINY
    Route::get('/povolenia/skupina/{group}', [PermissionController::class, 'group'])->name('permissions.group')->middleware('can:setGroup,App\Models\Permission');
    Route::patch('/povolenia/skupina/{group}', [PermissionController::class, 'groupSave'])->middleware('can:setGroup,App\Models\Permission');



});

Route::get('/profil/novy', [PlayerController::class, 'create'])->name('player.add');
Route::post('/profil/novy', [PlayerController::class, 'store']);
Route::get('/profil/upravit/{player?}', [PlayerController::class, 'edit']);

