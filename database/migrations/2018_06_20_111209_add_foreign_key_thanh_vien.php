<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyThanhVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thanhvien', function (Blueprint $table) {
            $table->foreign('capdo_id')
                ->references('id')
                ->on('capdo')
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
        Schema::table('thanhvien', function (Blueprint $table) {
            $table->dropForeign('thanhvien_capdo_id_foreign');
        });
    }
}
