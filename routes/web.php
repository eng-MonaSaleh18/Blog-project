<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth'])->group(function () {
    Route::get('/' , [PostController::class , 'index'])->name('get.index');
    Route::get('/posts/add' , [PostController::class , 'create'])->name('get.create');
    Route::post('/poststore' , [PostController::class , 'store'])->name('post.store');
    Route::get('/postshow/{post}' , [PostController::class , 'show'])->name('post.show');
    Route::get('/postedit/{post}' , [PostController::class , 'edit'])->name('post.edit');
    Route::put('/postupdate/{post}' , [PostController::class , 'update'])->name('post.update');
    Route::delete('/delete/{post}' , [PostController::class , 'destroy'])->name('post.destroy');

    Route::post('/commentstore/{post}' , [CommentController::class , 'store']);
    Route::get('/comm_edit/{comment}' , [CommentController::class , 'edit']);
    Route::put('/commentupdate/{comment}' , [CommentController::class , 'update']);
    Route::delete('/commentdelete/{comment}' , [CommentController::class , 'destroy']);

    Route::get('/admin' , [CategoryController::class , 'index'])->name('get.admin.index');
    Route::get('/add' , [CategoryController::class , 'create'])->name('get.add.create');
    Route::post('/post' , [CategoryController::class , 'store'])->name('post.post.store');
    Route::get('/show/{category}' , [CategoryController::class , 'show'])->name('get.show');
    Route::get('/editcategory/{category}' , [CategoryController::class , 'edit'])->name('get.edit');
    Route::put('/update/{category}' , [CategoryController::class , 'update'])->name('put.update');
    Route::delete('/deletecategory/{category}' , [CategoryController::class , 'destroy'])->name('delete.cat.destroy');


    Route::get('/indextag' , [TagController::class , 'index'])->name('index.tag');
    Route::get('/createtag' , [TagController::class , 'create'])->name('create.tag');
    Route::post('/storetag' , [TagController::class , 'store'])->name('store.tag');
    Route::get('/edittag/{tag}' , [TagController::class , 'edit'])->name('edit.tag');
    Route::put('/updatetag/{tag}' , [TagController::class , 'update'])->name('update.tag');
    Route::delete('/delatetag/{tag}' , [TagController::class , 'destroy'])->name('destroy.tag');

    Route::get('/user_index' , [UserController::class , 'index']);
    Route::post('/user_update' , [UserController::class , 'update']);

    Route::get('logout' , [AuthController::class , 'logout'])->name('logout');
}); 

Route::middleware(['guest'])->group(function () {
    Route::get('login' , [AuthController::class , 'showForm'])->name('login');
    Route::post('login' , [AuthController::class , 'login'])->name('login'); 
    Route::get('register' , [AuthController::class , 'registerForm'])->name('register');
    Route::post('register' , [AuthController::class , 'register'])->name('register');
}); 


