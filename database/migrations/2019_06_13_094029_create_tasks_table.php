<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('taskName');
            $table->string('status')->default(0);
            $table->string('file')->nullable();

            $table->date('deadline');
            $table->string('description',1000)->nullable();

            $table->string('clientName', 100)->nullable();
            $table->string('clientNumber',20)->nullable();
            $table->double('clientLatitude')->nullable();
            $table->double('clientLongitude')->nullable();

            $table->integer('createdBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
