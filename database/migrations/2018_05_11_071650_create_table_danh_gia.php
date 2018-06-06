<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDanhGia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhgia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('thanhvien_id');
            $table->unsignedInteger('sanpham_id');
            $table->string('tieude', 255);
            $table->string('noidung', 1500);
            $table->boolean('tinhtrang')->default(FALSE);
            $table->smallInteger('votes')->comment('Đánh giá số sao tối đa 10');
            $table->timestamps();

            $table->primary(['thanhvien_id', 'sanpham_id']);

            $table->foreign('sanpham_id')
                ->references('id')
                ->on('sanpham')
                ->onUpdate('cascade');
            $table->foreign('thanhvien_id')
                ->references('user_id')
                ->on('thanhvien')
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
        Schema::dropIfExists('danhgia');
    }
}
