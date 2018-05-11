<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChiTietDaiLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdaily', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('daily_id')->comment('Thành viên được làm đại lý');
            $table->unsignedInteger('hoadon_id');
            $table->float('chietkhau')->comment('Chiết khấu được tính cho hóa đơn này'); //vd: 0.1 hoặc 0.05
            $table->timestamps();

            $table->primary('daily_id');
            $table->foreign('daily_id')
                ->references('thanhvien_id')
                ->on('daily')
                ->onUpdate('cascade');
            $table->foreign('hoadon_id')
                ->references('id')
                ->on('hoadon')
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
        Schema::dropIfExists('chitietdaily');
    }
}
