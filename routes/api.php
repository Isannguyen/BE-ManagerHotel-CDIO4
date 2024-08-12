<?php

use App\Http\Controllers\DichVuController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LoaiPhongController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\TrangChuController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/lay-du-lieu-phong', [TrangChuController::class, 'getData']);
Route::get('/lay-du-lieu-all-phong', [TrangChuController::class, 'getDataAll']);
Route::group(['prefix'  =>  '/admin'], function () {
    Route::group(['prefix'  =>  '/nhan-vien'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [NhanVienController::class, 'getData']);
        Route::post('/tao-nhan-vien', [NhanVienController::class, 'createNhanVien']);
        Route::delete('/xoa-nhan-vien/{id}', [NhanVienController::class, 'xoaNhanVien']);
        Route::put('/cap-nhat-nhan-vien', [NhanVienController::class, 'capNhatNhanVien']);
        Route::put('/doi-trang-thai', [NhanVienController::class, 'doiTrangThaiNhanVien']);
    });
});
Route::group(['prefix'  =>  '/admin'], function () {
    Route::group(['prefix'  =>  '/khach-hang'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [KhachHangController::class, 'getData']);
        Route::post('/tao-khach-hang', [KhachHangController::class, 'createKhachHang']);
        Route::delete('/xoa-khach-hang/{id}', [KhachHangController::class, 'xoaKhachHang']);
        Route::put('/cap-nhat-khach-hang', [KhachHangController::class, 'capNhatKhachHang']);
        Route::put('/doi-trang-thai', [KhachHangController::class, 'doiTrangThaiKhachHang']);
    });
});
Route::group(['prefix'  =>  '/admin'], function () {
    Route::group(['prefix'  =>  '/loai-phong'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [LoaiPhongController::class, 'getData']);
        Route::get('/lay-du-lieu-hoat-dong', [LoaiPhongController::class, 'getDataHoatDong']);
        Route::post('/tim-loai-phong', [LoaiPhongController::class, 'searchLoaiPhong']);
        Route::post('/tao-loai-phong', [LoaiPhongController::class, 'createLoaiPhong']);
        Route::delete('/xoa-loai-phong/{id}', [LoaiPhongController::class, 'xoaLoaiPhong']);
        Route::put('/cap-nhat-loai-phong', [LoaiPhongController::class, 'capNhatLoaiPhong']);
        Route::put('/doi-trang-thai', [LoaiPhongController::class, 'doiTrangThaiLoaiPhong']);
    });
});
Route::group(['prefix'  =>  '/admin'], function () {
    Route::group(['prefix'  =>  '/dich-vu'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [DichVuController::class, 'getData']);
        Route::post('/tim-dich-vu', [DichVuController::class, 'searchDichVu']);
        Route::post('/tao-dich-vu', [DichVuController::class, 'createDichVu']);
        Route::delete('/xoa-dich-vu/{id}', [DichVuController::class, 'xoaDichVu']);
        Route::put('/cap-nhat-dich-vu', [DichVuController::class, 'capNhatDichVu']);
        Route::put('/doi-trang-thai', [DichVuController::class, 'doiTrangThaiDichVu']);
    });
});
Route::group(['prefix'  =>  '/admin'], function () {
    Route::group(['prefix'  =>  'phong'], function () {
        // Lấy dữ liệu  -> get
        Route::get('/lay-du-lieu', [PhongController::class, 'getData']);
        Route::post('/tao-phong', [PhongController::class, 'createPhong']);
        Route::delete('/xoa-phong/{id}', [PhongController::class, 'xoaPhong']);
        Route::put('/cap-nhat-phong', [PhongController::class, 'capNhatPhong']);
        Route::put('/doi-trang-thai', [PhongController::class, 'doiTrangThaiPhong']);
    });
});

