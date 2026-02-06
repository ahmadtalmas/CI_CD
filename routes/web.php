<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
Route::get('/', function () {
    // for testing we use dd("test");
    /*$test for test print code*/
    // $test= "احمد التلمس','120221574','تصميم وبرمجة تطبيقات الموبايل";
    // return view('welcome',compact('test')); <?php echo $test; in blade
    return view('welcome');
});
// Route::get('/home/{id}',function($id){
// dd($id); will print anything we write now
// });
/*get post put delete is methods*/

/*this is access for class = route initialize = controller*/
/*index is function it supposed to be inside Homecontroller*/

Route::get('/user-posts/{id}',[HomeController::class,'userPosts']);
Route::get('/index',[HomeController::class,'index'])->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/store',[HomeController::class,'store']);
Route::post('/index/update/{id}',[HomeController::class,'update'])->name('index.update');
Route::post('/login',[AuthController::class,'login']);