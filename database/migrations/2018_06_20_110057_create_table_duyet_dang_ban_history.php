<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDuyetDangBanHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duyetdangbanhistory', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('dangban_id');
            $table->string('comment', 1000);
            $table->boolean('status')->default(FALSE)->comment('TRUE là đăng bán có thể hiển thị hoặc không');
            $table->timestamps();

            $table->foreign('dangban_id')
                ->references('id')
                ->on('dangban')
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
        Schema::dropIfExists('duyetdangbanhistory');
    }
}
