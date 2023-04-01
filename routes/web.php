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
    //Articles Routes
    Route::get('/makaleler/silinenler',[App\Http\Controllers\backend\ArticleController::class,'trashed'])->name('trashed.article');
    Route::resource('/makaleler',App\Http\Controllers\backend\ArticleController::class);
    Route::get('/switch',[App\Http\Controllers\backend\ArticleController::class,'switch'])->name('switch');
    Route::get('/deletearticle/{id}',[App\Http\Controllers\backend\ArticleController::class,'delete'])->name('delete.article');
    Route::get('/harddeletearticle/{id}',[App\Http\Controllers\backend\ArticleController::class,'hardDelete'])->name('hard.delete.article');
    Route::get('/recoverarticle/{id}',[App\Http\Controllers\backend\ArticleController::class,'recover'])->name('recover.article');
    //Categories Routes
    Route::resource('/kategoriler',App\Http\Controllers\backend\categoryController::class);
    Route::post('/kategori/delete',[App\Http\Controllers\backend\categoryController::class,'delete'])->name('category.delete');
    Route::post('/kategori/duzelt',[\App\Http\Controllers\backend\categoryController::class,'repair'])->name('category.repair');
    Route::get('/kategori/status',[\App\Http\Controllers\backend\categoryController::class,'switch'])->name('category.switch');
    Route::get('/kategori/getData',[\App\Http\Controllers\backend\categoryController::class,'getData'])->name('category.getdata');
    //Pages Routes
    Route::get('/sayfalar/silinenler',[App\Http\Controllers\backend\PageController::class,'trashed'])->name('page.trashed');
    Route::get('/sayfalar',[\App\Http\Controllers\backend\PageController::class,'index'])->name('page.index');
    Route::get('/sayfa/switch',[\App\Http\Controllers\backend\PageController::class,'switch'])->name('page.switch');
    Route::get('/deletepage/{id}',[App\Http\Controllers\backend\PageController::class,'delete'])->name('page.delete');
    Route::get('/harddeletepage/{id}',[App\Http\Controllers\backend\PageController::class,'hardDelete'])->name('page.hard.delete');
    Route::get('/recoverpage/{id}',[App\Http\Controllers\backend\PageController::class,'recover'])->name('page.recover');


    Route::get('cikis',[\App\Http\Controllers\backend\Authh::class,'logOut'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Web Front
|--------------------------------------------------------------------------
*/

Route::get('/',[\App\Http\Controllers\Front\HomepageController::class,'index'])->name('homepage');
Route::get('Anasayfa',[\App\Http\Controllers\Front\HomepageController::class,'index']);
Route::get('iletisim',[\App\Http\Controllers\Front\HomepageController::class,'contact'])->name('contact');
Route::post('iletisim',[\App\Http\Controllers\Front\HomepageController::class,'contactpost'])->name('contact.post');
Route::get('kategori/{category}',[\App\Http\Controllers\Front\HomepageController::class,'category'])->name('category');
Route::get('{category}/{slug}',[\App\Http\Controllers\Front\HomepageController::class,'single'])->name('single');
Route::get('{slug}',[\App\Http\Controllers\Front\HomepageController::class,'page'])->name('page');


