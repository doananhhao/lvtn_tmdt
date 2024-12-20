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
            $table->string('mota', 1000)->nullable();
            $table->dateTime('ngayhethan'); //ngày hết hạn đăng bán
            $table->boolean('canduyet')->default(TRUE); //TRUE: yêu cầu duyệt, FALSE: chưa yêu cầu OR cần edit lại để yêu cầu duyệt
            $table->boolean('ngungban')->default(FALSE)->comment('Do người bán chủ động chọn ngừng hiển thị trang chủ');
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
