<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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

Route::group(['middleware' => 'auth'], function () {

    Route::resource('article', ArticleController::class)->except(['edit','show']);
    Route::get('listArticle',[ArticleController::class,'listArticle']);
    Route::post('load-article', [ArticleController::class,'loadMoreArticle'])->name('load-article');
    Route::get('article/show/{id}',[ArticleController::class,'show'])->name('article.show');
    Route::get('article/edit/{id}',[ArticleController::class,'edit']);
    Route::post('article/deletes',[ArticleController::class,'deletes']);
    
    Route::resource('category',CategoryController::class)->except(['create','edit']);
    Route::get('listCategory',[CategoryController::class,'listCategory']);
    Route::post('category/deletes',[CategoryController::class,'deletes']);

    Route::resource('users',UserController::class)->except(['create','edit']);
    Route::get('listUser',[UserController::class,'listUser']);
    Route::post('users/deletes',[UserController::class,'deletes']);
    Route::get('profile/edit/{id}',[UserController::class,'edit'])->name('users.edits');
    Route::patch('users/update-profile/{id}',[UserController::class,'updateProfile'])->name('update-profile');

    Route::resource('role',RoleController::class)->except(['create','edit']);
    Route::get('listRole',[RoleController::class,'listRole']);
    Route::post('role/deletes',[RoleController::class,'deletes']);


    Route::resource('permission',PermissionController::class)->except(['create','edit']);
    Route::get('listPermission',[PermissionController::class,'listPermission']);
    Route::post('permission/deletes',[PermissionController::class,'deletes']);
    
    Route::get('/',[ArticleController::class,'home'])->name('home');

    Route::post('logout',[AuthController::class,'logout'])->name('logout');

});


Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'checkLog']);
Route::get('forgot-password',[AuthController::class,'forgotPassword'])->name('forgot-password');
Route::post('forgot-password',[AuthController::class,'sendMail'])->name('forgot-password.send');
Route::get('forgot-password/{token}',[AuthController::class,'showForm'])->name('forgot-password.form');
Route::post('forgot-password/{token}',[AuthController::class,'confirmChange'])->name('forgot-password.confirm');
Route::get('forgot-password/success/{token}',[AuthController::class,'forgotPasswordSuccess'])->name('forgot-password.success');
