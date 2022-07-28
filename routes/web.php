<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;
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

Route::get('/', 'Controller@home')->name('home');
Route::get('/add-post', 'Controller@add_post')->name('add-post');
Route::post('/store-post', 'Controller@store_post')->name('store-post');
Route::get('/post-details/{slug}', 'Controller@post_details')->name('post-details');
Route::get('/edit-post/{slug}', 'Controller@edit_post')->name('edit-post');
Route::post('/store-edited-post/{slug}', 'Controller@store_edited_post')->name('store-edited-post');
Route::post('/delete-post/{slug}', 'Controller@delete_post')->name('delete-post');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});
