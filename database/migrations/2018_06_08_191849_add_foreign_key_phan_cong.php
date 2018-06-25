<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPhanCong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phancong', function (Blueprint $table) {
            $table->foreign('nhanvien_id')
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
        Schema::table('phancong', function (Blueprint $table) {
            $table->dropForeign('phancong_nhanvien_id_foreign');
        });
    }
}
