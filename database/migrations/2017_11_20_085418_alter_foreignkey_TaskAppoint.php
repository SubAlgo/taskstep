<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignkeyTaskAppoint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Appoint', function (Blueprint $table) {
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
        Schema::table('Appoint', function (Blueprint $table) {
            //
        });
    }
}
