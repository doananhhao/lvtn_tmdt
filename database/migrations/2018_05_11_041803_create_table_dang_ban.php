<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDangBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangban', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('thanhvien_id');
            $table->unsignedInteger('sanpham_id');
            $table->dateTime('ngayhethan'); //ngày hết hạn đăng bán
            $table->boolean('tinhtrang')->default(FALSE); //TRUE: đã duyệt, FALSE: đang chờ duyệt
            $table->timestamps();

            $table->foreign('thanhvien_id')
                ->references('user_id')
                ->on('thanhvien')
                ->onUpdate('cascade');
            $table->foreign('sanpham_id')
                ->references('id')
                ->on('sanpham')
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
        Schema::dropIfExists('dangban');
    }
}
