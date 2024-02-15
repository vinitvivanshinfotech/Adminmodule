<?php

use App\Http\Controllers\SocialiteControllerg;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('admin',UserController::class);

// this route call the dashboard page of admin
Route::get('/admindashboard',[UserController::class,'index'])->name('admin.dashboard');

// This route is define for  user registration
Route::get('/adminregister',[UserController::class,'create'])->name('admin.register');

// This route is define  for store data into database from user registration form
Route::post('/adminadded', [UserController::class, 'store'])->name('admin.add');

// This route is define for
Route::get('/adminedit/{id}',[UserController::class,'edit'])->name('admin.edit');

Route::post('/adminupdate',[UserController::class,'update'])->name('admin.update');

Route::get('admindelete/{id}',[UserController::class,'destroy'])->name('admin.delete');



Route::get('/userlogin',[UserController::class,'login'])->name('user.login');

Route::post('authenticate',[UserController::class,'authenticate'])->name('authenticate');

Route:: view('/userdashboard','user.dashboard')->name('user.dashboard');


Route::get('/auth/google',[SocialiteController::class,'singin'])->name('singin');

Route::get('callback/google',[SocialiteController::class,'callback']);

Route::view('/dashboard', 'user.dashboard')->name('dashboard');

Route::get('/auth/github',[SocialiteController::class,'githredirect'])->name('singin');

Route::get('github/callback',[SocialiteController::class,'callbackgit']);



// Route::get('/emailtest',function(){

//     $details['email'] = "vinit.m@vivanshinfotech.com";

//     dispatch(new App\Jobs\sendmail($details));
//     dd('okay send');
// });
