<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\ReplyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routing sederhana
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::get('pendataan', function () {
//     return view('pendataan');
// })->name('pendataan');
// end

//passing data
// Route::get('/', [TestController::class, 'home'])->name('home');

// Route::get('/pendataan', [TestController::class, 'data'])->name('pendataan');

// Route::get('/data/{nama}', [TestController::class, 'datanama'])->name('data-nama');

// Route::get('/daftar', [TestController::class, 'daftar'])->name('daftar');

// Route::post('/kirim', [TestController::class, 'kirim'])->name('kirim');
//passing data selesai

// blade
Route::get('/', [DashboardController::class, 'home'])->name('home');
Route::get('/about', [DashboardController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {
    // create data category
    Route::get('/categories/categories', [CategoriesController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('category.store');

    // Read Data Category
    Route::get('/categories', [CategoriesController::class, 'index'])->name('category.index');

    //update data category
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('category.update');

    //Delete data category
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.edit');

    //comment
    Route::post('/comment/{news_id}', [CommentController::class, 'store'])->name('comment.store');
    //reply
    Route::post('/reply/{coment_id}', [ReplyController::class, 'store'])->name('replies.store');
});
Route::get('/categories/{id}', [CategoriesController::class, 'show'])->name('category.show');
Route::get('/news/detail/{id}', [NewsController::class, 'detail'])->name('news.detail');
//CRUD News
Route::resource('news', NewsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
