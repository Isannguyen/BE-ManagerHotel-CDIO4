<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class TrangChuController extends Controller
{
    public function getData(){
        $phong = Phong::join('loai_phongs', 'loai_phongs.id', 'phongs.ma_loai_phong')
                        ->where('phongs.tinh_trang', 1)
                        ->select('phongs.*', 'loai_phongs.ten_loai_phong', 'loai_phongs.mo_ta')
                        ->take(9)
                        ->get();
        return response()->json([
            'data'  =>  $phong,
        ]);
    }

    public function getDataAll(){
        $phong = Phong::join('loai_phongs', 'loai_phongs.id', 'phongs.ma_loai_phong')
                        ->where('phongs.tinh_trang', 1)
                        ->select('phongs.*', 'loai_phongs.ten_loai_phong', 'loai_phongs.mo_ta')
                        ->get();
        return response()->json([
            'data'  =>  $phong,
        ]);
    }
}
