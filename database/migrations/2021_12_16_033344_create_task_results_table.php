<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tasks_id');
            $table->integer('task_type_id'); //ig: retweet, follow, love, etc
            $table->integer('status');
            $table->string('additional_message')->nullable(); //for saving something
            $table->timestamps();

            $table->foreign('tasks_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_results');
    }
}
