<?php

namespace App\Http\Controllers;

use App\Models\DichVu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DichVuController extends Controller
{
    public function getData()
    {
        $data   = DichVu::select('id', 'ten_dich_vu', 'gia_dich_vu', 'tinh_trang',)
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'dich_vu'  =>  $data,
        ]);
    }

    public function getDataHoatDong()
    {
        $data   = DichVu::where('tinh_trang', 1)->get(); // get là ra 1 danh sách

        return response()->json([
            'dich_vu'  =>  $data,
        ]);
    }

    public function searchDichVu(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = DichVu::where('ten_dich_vu', 'like', $key)
                         ->get(); // get là ra 1 danh sách

        return response()->json([
            'dich_vu'  =>  $data,
        ]);
    }


    public function createDichVu(Request $request)
    {
        DichVu::create([
            'ten_dich_vu' => $request->ten_dich_vu,
            'gia_dich_vu' => $request->gia_dich_vu,
            'tinh_trang'  => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Tạo dịch vụ thành công!',
        ]);
    }

    public function xoaDichVu($id){
        try {
            DichVu::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa dịch vụ thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function capNhatDichVu(Request $request)
    {
        try {
            DichVu::where('id', $request->id)
                  ->update([
                    'ten_dich_vu'       => $request->ten_dich_vu,
                    'gia_dich_vu'      => $request->gia_dich_vu,
                    'tinh_trang'    => $request->tinh_trang,
                  ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật tên dịch vụ thành ' . $request->ten_dich_vu,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTrangThaiDichVu(Request $request)
    {
        try {
            if($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            DichVu::where('id', $request->id)
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
