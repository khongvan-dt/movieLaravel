<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\RapChieuController;
use App\Http\Controllers\movieController;
use App\Http\Controllers\chairController;
use App\Http\Controllers\phimRapController;
use App\Http\Controllers\showTimeController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\buyController;


use Illuminate\Support\Facades\Auth;


// web
Route::get('/', function () {
    return view('web.index');
})->name('index');
Route::get('/', [buyController::class, 'listBuy'])->name('index');

Route::get('login', function () {
    return view('web.login');
})->name('login');

Route::get('register', function () {
    return view('web.register');
})->name('register');
Route::post('insert', [registerController::class, 'insert'])->name('insert');


Route::middleware('checkLogin::customer')->group(function () {
    Route::get('buy', function () {
        return view('web.by');
    })->name('buy');
    Route::get('/buy/{lichChieuId}/{movieId}', [BuyController::class, 'buy'])->name('by');
    // Route::post('save', [BuyController::class, 'save'])->name('save');

    Route::get('ticket', function () {
        return view('web.ticket');
    })->name('ticket');
    Route::get('showTicket', [BuyController::class, 'showTicket'])->name('showTicket');
    Route::get('insertTicket', [BuyController::class, 'insertTicket'])->name('insertTicket');

    Route::get('/end', function () {
        return view('web.end');
    })->name('end');
    Route::get('end', [BuyController::class, 'end'])->name('end');

});

// ad 
Route::post('loginc', [UserAdminController::class, 'login'])->name('loginc');
Route::get('/logout', [UserAdminController::class, 'logout'])->name('logout');

// cấu trúc route 
// route::method('/page', name controller::class, tên method trong controller)
Route::middleware('checkLogin::admin')->group(function () {



    Route::get('addCategory', function () {
        return view('admin.add_category');
    })->name('addCategory');
    Route::get('addCategory', [TheLoaiController::class, 'listTheLoai'])->name('addCategory');
    Route::post('/addCategory/save', [TheLoaiController::class, 'themTheLoai'])->name('saveCategory');
    Route::get('/addCategory/delete/{Categoryid}', [TheLoaiController::class, 'deleteCategory'])->name('deleteCategory');
    Route::get('/editCategory/{id}', [TheLoaiController::class, 'editCategory'])->name('editCategory');
    Route::post('/updateCategory/{id}', [TheLoaiController::class, 'updateCategory'])->name('updateCategory');





    Route::get('addproduct', function () {
        return view('admin.add_products');
    })->name('addProducts');
    Route::get('/addProducts', [RapChieuController::class, 'listCinema'])->name('addProducts');
    Route::post('/addProducts/save', [RapChieuController::class, 'addCinema'])->name('saveCinema');
    Route::get('/addProducts/delete/{id}', [RapChieuController::class, 'deleteCinema'])->name('deleteCinema');
    Route::get('/editProducts/{id}', [RapChieuController::class, 'editCinema'])->name('editProducts');
    Route::post('/editProducts/{id}', [RapChieuController::class, 'updateCinema'])->name('updateCinemas');


    Route::get('addChair', function () {
        return view('admin.addChair');
    })->name('addChair');
    Route::get('addChair', [chairController::class, 'listRap'])->name('addChair');
    Route::post('/addChair/save', [chairController::class, 'addChair'])->name('saveChair');
    Route::delete('addChair/delete-chair/{ChairId}', [chairController::class, 'deleteChair'])->name('deleteChair');
    Route::get('/edit/{ChairId}', [chairController::class, 'editChair'])->name('edit');
    Route::put('/editChair/{ChairId}', [chairController::class, 'updateChair'])->name('updateChair');


    Route::get('addMovie', function () {
        return view('admin.addMovie');
    })->name('addMovie');
    Route::get('addMovies', [movieController::class, 'listTheLoai'])->name('addMovie');
    Route::post('/addMovie/save', [movieController::class, 'addMovie'])->name('saveMovie');


    Route::get('table', function () {
        return view('admin.tables');
    })->name('TablePage');
    Route::get('table', [movieController::class, 'listMovie'])->name('TablePage');
    Route::get('/editMovie/{movieId}', [movieController::class, 'editMovie'])->name('editMovie');
    Route::post('/TablePage/delete/{movieId}', [MovieController::class, 'deleteMovie'])->name('deleteMovies');
    Route::put('/updateMovie/{movieId}', [MovieController::class, 'updateMovie'])->name('updateMovies');

    Route::get('moreMovieTheater', function () {
        return view('admin.moreMovieTheater');
    })->name('phimRaps');
    Route::get('moreMovieTheater', [phimRapController::class, 'list'])->name('phimRaps');
    Route::post('insertData', [phimRapController::class, 'insert'])->name('insertData');

    Route::get('addSTime', function () {
        return view('admin.addSTime');
    })->name('addShowTime');
    Route::get('addSTime', [showTimeController::class, 'listMovie'])->name('addShowTime');
    Route::match(['get', 'post'], '/addtime/{rapId}/{movieId}', [showTimeController::class, 'addtime'])->name('addtime');
});
