<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('homes');
Route::get('/blog', [App\Http\Controllers\FrontendController::class, 'blog'])->name('blog');

Auth::routes();
// Auth::routes(['verify' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);

    //Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'approve'])->name('users.approve');
    Route::get('/sendmail/{id}', [\App\Http\Controllers\UserController::class, 'sendmail'])->name('sendmail');
    Route::patch('/user/{id}', [\App\Http\Controllers\UserController::class, 'updateapp'])->name('users.updateapp');
    // Route::get('document', [\App\Http\Controllers\ProfileController::class, 'show'])->name('document.show');
    Route::resource('/users', UserController::class);
    // Route::get('document', function () {
    //     return view('document');
    // })->name('document.show');
    Route::resource('document', DokumenController::class);
    //laporan
    Route::get('/peserta/config', [\App\Http\Controllers\UserController::class, 'config'])->name('users.report');
    Route::get('/peserta/config2', [\App\Http\Controllers\UserController::class, 'config2'])->name('users.report2');
    //Route::get('/peserta/config', [\App\Http\Controllers\UserController::class, 'config2'])->name('config');
    //Route::get('/artcle/add', [\App\Http\livewire\Article::class, 'add'])->name('articleadd');
    Route::view('booking', 'booking')->name('booking');
    Route::get('/booking/print/{id}', [PrintController::class, 'prints'])->name('booking.print');

    //Profil site
    Route::group(['middleware' => ['permission:configurasi-list']], function () {
        Route::view('configurasi', 'configurasi')->name('configurasi');
    });
    //Banner
    Route::group(['middleware' => ['permission:banner-list']], function () {
        Route::view('banner', 'banner')->name('banner');
    });
    //category blog
    Route::group(['middleware' => ['permission:kategori-list']], function () {
        Route::view('kategori', 'kategori')->name('kategori');
    });
    //article
    Route::group(['middleware' => ['permission:article-list']], function () {
        Route::view('article', 'article')->name('article');
        //edit
        Route::resource('artikels', FrontendController::class);

    });
    //readarticle
    Route::get('/artikel/{slug}', [FrontendController::class, 'singleblog'])->name('artikel.read');
    //add article
    //Route::view('add_article', 'add_article')->name('add_article');

//Route search
Route::get('/search', [UserController::class, 'search'])->name('search');
});
Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });
 Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/symlink', function () {
    Artisan::call('storage:link');
});
 Auth::routes(['verify' => true]);
