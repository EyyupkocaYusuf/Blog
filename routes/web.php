<?php

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Backend
|--------------------------------------------------------------------------
*/
Route::prefix('admin',)->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris',[\App\Http\Controllers\backend\Authh::class,'login'])->name('login');
    Route::post('giris',[\App\Http\Controllers\backend\Authh::class,'loginPost'])->name('login.post');
});

Route::prefix('admin',)->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel',[\App\Http\Controllers\backend\Dashboard::class,'index'])->name('dashboard');
    Route::resource('/makaleler',App\Http\Controllers\backend\ArticleController::class);
    Route::get('cikis',[\App\Http\Controllers\backend\Authh::class,'logOut'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Web Front
|--------------------------------------------------------------------------
*/

Route::get('/',[\App\Http\Controllers\Front\HomepageController::class,'index'])->name('homepage');
Route::get('sayfa',[\App\Http\Controllers\Front\HomepageController::class,'index']);
Route::get('iletisim',[\App\Http\Controllers\Front\HomepageController::class,'contact'])->name('contact');
Route::post('iletisim',[\App\Http\Controllers\Front\HomepageController::class,'contactpost'])->name('contact.post');
Route::get('kategori/{category}',[\App\Http\Controllers\Front\HomepageController::class,'category'])->name('category');
Route::get('{category}/{slug}',[\App\Http\Controllers\Front\HomepageController::class,'single'])->name('single');
Route::get('{slug}',[\App\Http\Controllers\Front\HomepageController::class,'page'])->name('page');


