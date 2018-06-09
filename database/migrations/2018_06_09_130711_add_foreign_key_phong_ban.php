<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyPhongBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phongban', function (Blueprint $table) {
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
        Schema::table('phongban', function (Blueprint $table) {
            $table->dropForeign('phongban_truongphong_id_foreign');
        });
    }
}
