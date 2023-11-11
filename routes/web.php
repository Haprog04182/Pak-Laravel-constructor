<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\RowController;
use App\Http\Controllers\PostFactory;
use App\Http\Controllers\TextController;

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
Route::get('/creator', [App\Http\Controllers\HomeController::class, 'creator']);

Route::resource('/courses', CourseController::class);

Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::post('/lessons/show', [LessonController::class, 'GetLessons'])->name('lessons.show');    

Route::post('/rows', [RowController::class, 'store'])->name('rows.store');
Route::post('/rows/show', [PostFactory::class, 'showRows'])->name('rows.show');

Route::resource('/text', TextController::class);

Route::post('/post/show', [PostFactory::class, 'show'])->name('posts.show');

Route::post('/post/text', [PostFactory::class, 'storeText'])->name('post.text.store');
Route::patch('/post/text/update', [PostFactory::class, 'updateText'])->name('post.text.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
