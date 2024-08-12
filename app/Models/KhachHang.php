<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'khach_hangs';

    protected $fillable = [
        'ho_va_ten',
        'gioi_tinh',
        'ngay_sinh',
        'cmnd',
        'so_dien_thoai',
        'dia_chi',
        'tinh_trang',
    ];
}
