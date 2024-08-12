<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KhachHangController extends Controller
{
    public function getData()
    {
        $data   = KhachHang::select('id', 'ho_va_ten', 'gioi_tinh', 'ngay_sinh', 'cmnd', 'so_dien_thoai', 'dia_chi', 'tinh_trang')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'khach_hang'  =>  $data,
        ]);
    }

    public function createKhachHang(Request $request)
    {
        KhachHang::create([
            'ho_va_ten' => $request->ho_va_ten,
            'gioi_tinh' => $request->gioi_tinh,
            'ngay_sinh' => $request->ngay_sinh,
            'cmnd'      => $request->cmnd,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'tinh_trang' => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới khách hàng thành công !',
        ]);
    }
    public function xoaKhachHang($id)
    {
        try {
            KhachHang::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa khách hàng thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatKhachHang(Request $request)
    {
        try {
            KhachHang::where('id', $request->id)
                ->update([
                'ho_va_ten' => $request->ho_va_ten,
                'gioi_tinh' => $request->gioi_tinh,
                'ngay_sinh' => $request->ngay_sinh,
                'cmnd'      => $request->cmnd,
                'so_dien_thoai' => $request->so_dien_thoai,
                'dia_chi' => $request->dia_chi,
                'tinh_trang' => $request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công khách hàng ! ' . $request->ho_va_ten,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiKhachHang(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            KhachHang::where('id', $request->id)
                ->update([
                    'tinh_trang'  => $tinh_trang_moi,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã đổi trạng thái thành công',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
}
