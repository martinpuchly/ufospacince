<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SettingController;


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

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



# ADMIN ROUTES START
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::name('admin.')->prefix('admin')->group(function () {

    Route::get('/uzivatelia', [UserController::class, 'index'])->name('users')->can('adminViewAny', App\Models\User::class);
    Route::get('/povolenia', [PermissionController::class, 'adminIndex'])->name('permissions')->can('adminIndex', App\Models\Permission::class);



#SKUPINY
    Route::get('/skupiny', [GroupController::class, 'index'])->name('groups')->can('viewAny', App\Models\Group::class);
    Route::post('/skupiny', [GroupController::class, 'store'])->name('group.add')->can('create', App\Models\Group::class);
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
    Route::post('/hrac/{player}/restore', [PlayerController::class, 'restore'])->name('player.restore')->can('restore', App\Models\Player::class);
    Route::delete('/hrac/{player}/destroy', [PlayerController::class, 'destroy'])->name('player.destroy')->can('destroy', App\Models\Player::class);
    Route::patch('/hrac/{player}/setuser', [PlayerController::class, 'setUser'])->name('player.setUser')->can('set_user', App\Models\Player::class);

#SLIDER
    Route::get('/slides', [SlideController::class, 'index'])->name('slides')->can('viewAny', App\Models\Slide::class);
    Route::get('/slide/novy', [SlideController::class, 'create'])->name('slide.add')->can('create', App\Models\Slide::class);
    Route::post('/slide/novy', [SlideController::class, 'store'])->can('create', App\Models\Slide::class);
    Route::get('/slide/upravit/{slide}', [SlideController::class, 'edit'])->name('slide.edit')->can('update', App\Models\Slide::class);
    Route::patch('/slide/upravit/{slide}', [SlideController::class, 'update'])->can('update', App\Models\Slide::class);
    Route::delete('/slide/vymazat/{slide}', [SlideController::class, 'delete'])->name('slide.delete')->can('delete', App\Models\Slide::class);

    Route::get('/slide/{slide}/setActive', [SlideController::class, 'setActive'])->name('slide.setActive')->can('update', App\Models\Slide::class);
    Route::get('/slide/{slide}/setDownPosition', [SlideController::class, 'setDownPosition'])->name('slide.setDownPosition')->can('update', App\Models\Slide::class);
    Route::get('/slide/{slide}/setUpPosition', [SlideController::class, 'setUpPosition'])->name('slide.setUpPosition')->can('update', App\Models\Slide::class);
    
   
#PAGES
    Route::get('/stranky', [PageController::class, 'index'])->name('pages')->can('index', App\Models\Page::class);
    Route::get('/stranky/nova', [PageController::class, 'create'])->name('page.add')->can('create', App\Models\Page::class);
    Route::post('/stranky/nova', [PageController::class, 'store'])->can('create', App\Models\Page::class);


    Route::get('/stranky/{page}/upravit', [PageController::class, 'edit'])->name('page.edit')->can('edit', App\Models\Page::class);
    Route::patch('/stranky/{page}/upravit', [PageController::class, 'update'])->can('edit', App\Models\Page::class);

    Route::post('/stranky/{page}/restore', [PageController::class, 'restore'])->name('page.restore')->can('restore', App\Models\Page::class);
    Route::delete('/stranky/{page}/delete', [PageController::class, 'delete'])->name('page.delete')->can('delete', App\Models\Page::class);
    Route::delete('/stranky/{page}/destroy', [PageController::class, 'destroy'])->name('page.destroy')->can('destroy', App\Models\Page::class);

#POSTS
    Route::get('/clanky', [PostController::class, 'adminIndex'])->name('posts')->can('index', App\Models\Post::class);
    Route::get('/clanky/novy', [PostController::class, 'create'])->name('post.add')->can('create', App\Models\Post::class);
    Route::post('/clanky/novy', [PostController::class, 'store'])->can('create', App\Models\Post::class);


    Route::get('/clanky/{post}/upravit', [PostController::class, 'edit'])->name('post.edit')->can('edit', App\Models\Post::class);
    Route::patch('/clanky/{post}/upravit', [PostController::class, 'update'])->can('edit', App\Models\Post::class);

    Route::post('/clanky/{post_id}/restore', [PostController::class, 'restore'])->name('post.restore')->can('restore', App\Models\Post::class);
    Route::delete('/clanky/{post}/delete', [PostController::class, 'delete'])->name('post.delete')->can('delete', App\Models\Post::class);
    Route::delete('/clanky/{post_id}/destroy', [PostController::class, 'destroy'])->name('post.destroy')->can('destroy', App\Models\Post::class);

#CONTACTS
    Route::get('/kontakty/{q?}', [ContactController::class, 'index'])->name('contacts')->can('viewAny', App\Models\Contact::class);
    Route::get('/kontakt/{contact}', [ContactController::class, 'show'])->name('contact.show')->can('view', App\Models\Contact::class);
    Route::patch('/kontakt/{contact}/saveStatus', [ContactController::class, 'saveStatus'])->name('contact.saveStatus')->can('saveStatus', App\Models\Contact::class);
    Route::delete('/kontakt/{contact}/vymazat', [ContactController::class, 'destroy'])->name('contact.delete')->can('destroy', App\Models\Contact::class);


#TRAININGS
    Route::get('/treningy/{q?}', [TrainingController::class, 'adminIndex'])->name('trainings')->can('viewAny', App\Models\Training::class); 
    Route::get('/trening/novy', [TrainingController::class, 'create'])->name('training.add')->can('create', App\Models\Training::class); 
    Route::post('/trening/novy', [TrainingController::class, 'store'])->can('create', App\Models\Training::class); 
    
    Route::get('/trening/{training}/upravit', [TrainingController::class, 'edit'])->name('training.edit')->can('edit', App\Models\Training::class); 
    Route::patch('/trening/{training}/upravit', [TrainingController::class, 'update'])->can('edit', App\Models\Training::class); 
    Route::delete('/trening/{training}/vymazat', [TrainingController::class, 'destroy'])->name('training.delete')->can('destroy', App\Models\Training::class); 

#SETTINGS
    Route::get('/nastavenia', [SettingController::class, 'index'])->name('settings')->can('edit', App\Models\Setting::class); 
    Route::get('/nastavenia/{setting}', [SettingController::class, 'edit'])->name('setting.edit')->can('edit', App\Models\Setting::class); 
    Route::patch('/nastavenia/{setting}', [SettingController::class, 'update'])->can('edit', App\Models\Setting::class); 


});
# ADMIN ROUTES KONIEC




#HRÁČI
    Route::get('/tim', [PlayerController::class, 'index'])->name('players');
    Route::get('/hrac/upravit/{player?}', [PlayerController::class, 'edit'])->name('player.edit')->can('edit', App\Models\Player::class);
    Route::patch('/hrac/upravit/{player?}', [PlayerController::class, 'update'])->can('edit', App\Models\Player::class);
    Route::delete('/hrac/vymazat/{player?}', [PlayerController::class, 'delete'])->name('player.delete')->middleware('can:delete,player');
    Route::get('/hrac/{player_id}', [PlayerController::class, 'show'])->name('player.show');



    Route::get('/kontakt', [ContactController::class, 'create'])->name('contact.add');
    Route::post('/kontakt', [ContactController::class, 'store']);


    Route::get('/treningy/{date?}', [TrainingController::class, 'index'])->name('trainings');
    Route::patch('/trening/savePresence/{training}/{presence}', [TrainingController::class, 'savePresence'])->name('training.savePresence');
    Route::get('/trening/{training}', [TrainingController::class, 'show'])->name('training')->can('show', App\Models\Training::class);


Route::get('/clanky/{tag?}', [PostController::class, 'index'])->name('posts');
Route::get('/clanok/{post_slug}', [PostController::class, 'show'])->name('post');

#STRÁNKY !POSLEDNÝ ROUTE
Route::get('/{page_slug}', [PageController::class, 'show'])->name('page');


Route::get('auth/{service}', [AuthController::class, 'redirectToProvider'])->name('auth.login');
Route::get('auth/{service}/callback', [AuthController::class, 'handleProviderCallback']);