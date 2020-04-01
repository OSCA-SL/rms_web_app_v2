<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * =============Artists===================
 * resources: index
 * auth: web
 * ========================================
 */
Route::resource('artists', 'ArtistController')->only([
    'index'
])->middleware('auth:web');

/**
 * =============Songs===================
 * auth: web
 * ========================================
 */
Route::get('songs/titles', 'SongController@getSongTitles')->middleware('auth:web')->name('songs.titles');
Route::get('song/rehash/{song}', "SongController@reHash")->name('rehash.submit');

Route::resource('songs', 'SongController')->only([
    'index', 'create', 'store', 'show'
])->middleware('auth:web');
