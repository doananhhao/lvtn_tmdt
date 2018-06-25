<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhanCong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phancong', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('hoadon_id');
            $table->unsignedInteger('nhanvien_id')->comment('user có loại user là NHÂN VIÊN');
            $table->string('comments', 2000);
            $table->boolean('status')->default(FALSE)->comment('TRUE là hoàn thành để, sau đó để TP xem xét lại');
            $table->timestamps();

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
        Schema::dropIfExists('phancong');
    }
}
