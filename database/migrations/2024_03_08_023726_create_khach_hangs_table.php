<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ho_va_ten');
            $table->integer('gioi_tinh');
            $table->date('ngay_sinh');
            $table->string('cmnd');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
