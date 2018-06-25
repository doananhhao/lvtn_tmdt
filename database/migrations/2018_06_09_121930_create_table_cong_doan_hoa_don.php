<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCongDoanHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congdoanhoadon', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('hoadon_id');
            $table->unsignedInteger('congdoan_id')->comment('Công đoạn đang làm');
            $table->unsignedInteger('truongphong_id')->comment('Người quản lý thực hiện công đoạn này');
            $table->boolean('status')->default(FALSE)->comment('TRUE là đã chuyển sang công đoạn tiếp theo');
            $table->timestamps();

            $table->foreign('hoadon_id')
                ->references('id')
                ->on('hoadon')
                ->onUpdate('cascade');
            $table->foreign('congdoan_id')
                ->references('id')
                ->on('congdoan')
                ->onUpdate('cascade');
            $table->foreign('truongphong_id')
                ->references('nhanvien_id')
                ->on('nhanvien')
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
        Schema::dropIfExists('congdoanhoadon');
    }
}
