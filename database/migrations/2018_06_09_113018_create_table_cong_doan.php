<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCongDoan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congdoan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('FK_congdoantruoc')->nullable();
            $table->unsignedInteger('FK_congdoansau')->nullable();
            $table->unsignedInteger('phongban_id');
            $table->string('mota', 1000)->nullable();
            $table->timestamps();

            $table->foreign('phongban_id')
                ->references('id')
                ->on('phongban')
                ->onUpdate('cascade');
            $table->foreign('FK_congdoantruoc')
                ->references('id')
                ->on('congdoan')
                ->onUpdate('cascade');
            $table->foreign('FK_congdoansau')
                ->references('id')
                ->on('congdoan')
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
        Schema::dropIfExists('congdoan');
    }
}
