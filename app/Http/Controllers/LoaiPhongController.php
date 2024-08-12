<?php

namespace App\Http\Controllers;

use App\Models\LoaiPhong;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoaiPhongController extends Controller
{
    public function index()
    {
        return view('loai_phong');
    }

    public function getData()
    {
        $data   = LoaiPhong::select('id','ten_loai_phong', 'mo_ta', 'tinh_trang')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'loai_phong'  =>  $data,
        ]);
    }

    public function getDataHoatDong()
    {
        $data   = LoaiPhong::where('tinh_trang', 1)->get(); // get là ra 1 danh sách

        return response()->json([
            'loai_phong'  =>  $data,
        ]);
    }

    public function searchLoaiPhong(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = LoaiPhong::where('ten_loai_phong', 'like', $key)
                         ->get(); // get là ra 1 danh sách

        return response()->json([
            'loai_phong'  =>  $data,
        ]);
    }

    public function createLoaiPhong(Request $request)
    {
        LoaiPhong::create([
            'ten_loai_phong'           => $request->ten_loai_phong,
            'mo_ta'          => $request->mo_ta,
            'tinh_trang'        => $request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới loại phòng thành công!',
        ]);
    }

    public function xoaLoaiPhong($id){
        try {
            LoaiPhong::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa loại phòng thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function capNhatLoaiPhong(Request $request)
    {
        try {
            LoaiPhong::where('id', $request->id)
                  ->update([
                    'ten_loai_phong'       => $request->ten_loai_phong,
                    'mo_ta'      => $request->mo_ta,
                    'tinh_trang'    => $request->tinh_trang,
                  ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật tên loại phòng thành ' . $request->ten_loai_phong,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTrangThaiLoaiPhong(Request $request)
    {
        try {
            if($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            LoaiPhong::where('id', $request->id)
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
