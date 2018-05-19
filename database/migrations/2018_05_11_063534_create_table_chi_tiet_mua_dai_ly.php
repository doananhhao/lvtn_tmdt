<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChiTietMuaDaiLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietmuadaily', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('chitiethoadon_id');
            $table->unsignedInteger('daily_id')->comment('Thành viên được làm đại lý');
            $table->float('chietkhau')->comment('Chiết khấu được tính cho hóa đơn này'); //vd: 0.1 hoặc 0.05
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietmuadaily');
    }
}
