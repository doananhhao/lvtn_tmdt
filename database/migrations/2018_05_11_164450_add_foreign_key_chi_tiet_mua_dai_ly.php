<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyChiTietMuaDaiLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chitietmuadaily', function (Blueprint $table) {
            $table->primary('chitiethoadon_id');
            $table->foreign('daily_id')
                ->references('thanhvien_id')
                ->on('daily')
                ->onUpdate('cascade');
            $table->foreign('chitiethoadon_id')
                ->references('id')
                ->on('chitiethoadon')
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
        Schema::table('chitietmuadaily', function (Blueprint $table) {
            $table->dropForeign('chitietmuadaily_chitiethoadon_id_foreign');
            $table->dropForeign('chitietmuadaily_daily_id_foreign');
        });
    }
}
