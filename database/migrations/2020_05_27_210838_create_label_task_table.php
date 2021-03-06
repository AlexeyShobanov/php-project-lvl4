<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelTaskTable extends Migration
{
    public function up()
    {
        Schema::create('label_task', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('label_id');
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->bigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('label_task');
    }
}
