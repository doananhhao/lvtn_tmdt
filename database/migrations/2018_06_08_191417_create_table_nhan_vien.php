<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNhanVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('nhanvien_id');
            $table->unsignedInteger('phongban_id');
            $table->unsignedInteger('chucvu_id');
            $table->unsignedInteger('luong')->default(0);
            $table->timestamps();

            $table->primary('nhanvien_id');

            $table->foreign('nhanvien_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');
            $table->foreign('phongban_id')
                ->references('id')
                ->on('phongban')
                ->onUpdate('cascade');
            $table->foreign('chucvu_id')
                ->references('id')
                ->on('chucvu')
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
        Schema::dropIfExists('nhanvien');
    }
}
