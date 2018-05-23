<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChiTietKhuyenMai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietkhuyenmai', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('loaikhuyenmai_id');
            $table->unsignedInteger('sanpham_id');
            $table->float('giamgia')->comment('Phần trăm giảm vd 0.1');
            $table->dateTime('ngaybd');
            $table->dateTime('ngayketthuc')->nullable();
            $table->timestamps();

            $table->foreign('sanpham_id')
                ->references('id')
                ->on('sanpham')
                ->onUpdate('cascade');
            $table->foreign('loaikhuyenmai_id')
                ->references('id')
                ->on('loaikhuyenmai')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietkhuyenmai');
    }
}
