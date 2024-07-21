<?php

use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\Admins\SanPhamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRoleAdminMiddleware;

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


Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');
// Route::get('/admin', function(){
//     return 'Đây là trang admin';
// })->middleware('auth.admin')->name('/admin');
// ----------------------------------------------
// Route::middleware('auth')->group(function () {
//     Route::get('/home', function () {
//         return view('home');
//     });
//     Route::middleware('auth.admin')->group(function () {
//         Route::get('/admin', function(){
//             return 'Đây là trang admin';
//         })->name('/admin');
//     });
// });
Route::middleware(['auth', 'auth.admin'])->prefix('admins')->as('admins.')->group(function(){
    Route::prefix('dasboard')->as('dasboard')->group(function(){
        Route::get('/', function () {
            return view('home');
        });
    });
    Route::prefix('danhmuc')->as('danhmuc.')->group(function(){
        Route::get('/list', [DanhMucController::class, 'index'])->name('index');
        Route::get('/create', [DanhMucController::class, 'create'])->name('create');
        Route::post('/store', [DanhMucController::class, 'store'])->name('store');
        Route::get('/show/{id}', [DanhMucController::class, 'show'])->name('show');
        Route::get('{id}/edit', [DanhMucController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [DanhMucController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [DanhMucController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('sanpham')->as('sanpham.')->group(function(){
        Route::get('/list', [SanPhamController::class, 'index'])->name('index');
        Route::get('/create', [SanPhamController::class, 'create'])->name('create');
        Route::post('/store', [SanPhamController::class, 'store'])->name('store');
        Route::get('/show/{id}', [SanPhamController::class, 'show'])->name('show');
        Route::get('{id}/edit', [SanPhamController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [SanPhamController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [SanPhamController::class, 'destroy'])->name('destroy');
    });
});