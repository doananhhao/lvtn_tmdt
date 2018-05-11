<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDaiLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('thanhvien_id');
            $table->string('hash')->comment('chữ ký điện tử mã hóa (md5, sha1)'); //chữ ký điện tử
            $table->float('chietkhau')->comment('Chiết khấu mặc định của đại lý'); //vd: 0.1 hoặc 0.05
            $table->timestamps();

            $table->primary('thanhvien_id');
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
        Schema::dropIfExists('daily');
    }
}
