<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignkeyTaskStap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Step', function (Blueprint $table) {
            $table->integer('task_id')->unsigned();

            $table->foreign('task_id')->references('id')->on('Task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Step', function (Blueprint $table) {
            //
        });
    }
}
