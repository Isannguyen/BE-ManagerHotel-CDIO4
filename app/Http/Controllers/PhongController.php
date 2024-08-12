<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PhongController extends Controller
{
    public function getData()
    {
        $data   = Phong::join('loai_phongs', 'loai_phongs.id', 'phongs.ma_loai_phong')
                       ->select('loai_phongs.ten_loai_phong','phongs.*')
            ->get(); // get là ra 1 danh sách

        return response()->json([
            'phong'  =>  $data,
        ]);
    }

    public function createPhong(Request $request)
    {
        // return response()->json($request->all());
        Phong::create([
            'ma_loai_phong' => $request->ma_loai_phong,
            'ten_phong'     =>$request->ten_phong,
            'gia_phong'     =>$request->gia_phong,
            'tinh_trang'    =>$request->tinh_trang,
        ]);

        return response()->json([
            'status'            =>   true,
            'message'           =>   'Đã tạo mới phòng thành công !',
        ]);
    }
    public function xoaPhong($id)
    {
        try {
            Phong::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa phòng thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function capNhatPhong(Request $request)
    {
        try {
            Phong::where('id', $request->id)
                ->update([
                    'ma_loai_phong' => $request->ma_loai_phong,
                    'ten_phong'     =>$request->ten_phong,
                    'gia_phong'     =>$request->gia_phong,
                    'tinh_trang'    =>$request->tinh_trang,
                ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công phòng ! ' . $request->ten_phong,
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }
    public function doiTrangThaiPhong(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            Phong::where('id', $request->id)
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
