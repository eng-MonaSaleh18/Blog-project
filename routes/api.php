<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register_user' , [AuthController::class , 'register']);
Route::post('/login_user' , [AuthController::class , 'login']);

Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('/postindex' , [PostController::class , 'index']);
    Route::get('/postshow/{post}' , [PostController::class , 'show']);
    Route::post('/poststore' , [PostController::class , 'store']); 
    Route::put('/postedit/{post}' , [PostController::class , 'update']); 
    Route::delete('/postdelete/{post}' , [PostController::class , 'destroy']); 

    Route::get('/posts/{post}/comment_index' , [CommentController::class , 'index']);
    Route::put('/posts/{post}/comment_update/{comment}' , [CommentController::class , 'update']);
    Route::delete('/comment_delete/{comment}' , [CommentController::class , 'destroy']);


    Route::post('/logout_user' , [AuthController::class , 'logout']);
});
