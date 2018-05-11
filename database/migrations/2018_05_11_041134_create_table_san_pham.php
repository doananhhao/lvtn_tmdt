<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSanPham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tensanpham');
            $table->float('gia');
            $table->string('mota', 10000);
            $table->string('hinhanh'); //tên hình đại điện của sản phẩm .*
            $table->unsignedInteger('loaisp_id');
            $table->unsignedInteger('nhacungcap_id');
            $table->timestamps();

            $table->foreign('loaisp_id')
                ->references('id')
                ->on('loaisp')
                ->onUpdate('cascade');
            $table->foreign('nhacungcap_id')
                ->references('id')
                ->on('nhacungcap')
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
        Schema::dropIfExists('sanpham');
    }
}
