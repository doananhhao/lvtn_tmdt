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
            $table->unsignedInteger('congviec_id');
            $table->unsignedInteger('hoadon_id');
            $table->unsignedInteger('nhanvien_id')->comment('user có loại user là NHÂN VIÊN');
            $table->boolean('hoanthanh')->default(FALSE);
            $table->boolean('active')->default(TRUE)->comment('Để xét thu hồi công việc nếu cần');
            $table->timestamps();

            $table->primary(['congviec_id', 'hoadon_id', 'nhanvien_id']);

            $table->foreign('congviec_id')
                ->references('id')
                ->on('congviec')
                ->onUpdate('cascade');
            $table->foreign('hoadon_id')
                ->references('id')
                ->on('hoadon')
                ->onUpdate('cascade');
            $table->foreign('nhanvien_id')
                ->references('id')
                ->on('users')
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
        //
    }
}
