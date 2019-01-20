<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('problem_id');
            $table->string('file_path')->nullable();
            $table->enum('language', ['c', 'cpp', 'java']);
            $table->enum('status', ['YES', 'NO:TimeLimitExceeded', 'NO:CompilationError', 'NO:RunTimeError', 'NO:WrongAnswer', 'NO:ContactTA', 'DELETED', 'PENDING']);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
