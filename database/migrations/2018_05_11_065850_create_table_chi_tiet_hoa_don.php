<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChiTietHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiethoadon', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('sanpham_id');
            $table->unsignedInteger('loaikhuyenmai_id')->nullable();
            $table->unsignedInteger('soluong'); //số lượng sản phẩm
            $table->float('gia')->comment('Gía tại thời điểm bán của sản phẩm');
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
        Schema::dropIfExists('chitiethoadon');
    }
}
