<?php

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Backend
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard',[\App\Http\Controllers\backend\Dashboard::class,'index'])->name('admin.dashboard');
Route::get('/admin/giris',[\App\Http\Controllers\backend\Auth::class,'login'])->name('admin.login');
/*
|--------------------------------------------------------------------------
| Web Front
|--------------------------------------------------------------------------
*/

Route::get('/',[\App\Http\Controllers\Front\HomepageController::class,'index'])->name('homepage');
Route::get('/sayfa/',[\App\Http\Controllers\Front\HomepageController::class,'index']);
Route::get('/iletisim',[\App\Http\Controllers\Front\HomepageController::class,'contact'])->name('contact');
Route::post('/iletisim',[\App\Http\Controllers\Front\HomepageController::class,'contactpost'])->name('contact.post');
Route::get('/kategori/{category}',[\App\Http\Controllers\Front\HomepageController::class,'category'])->name('category');
Route::get('/{category}/{slug}',[\App\Http\Controllers\Front\HomepageController::class,'single'])->name('single');
Route::get('/{slug}',[\App\Http\Controllers\Front\HomepageController::class,'page'])->name('page');


