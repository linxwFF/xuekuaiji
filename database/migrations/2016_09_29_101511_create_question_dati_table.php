<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionDatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //大题库
        Schema::create('question_dati', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('f_id')->default(0);
            $table->text('subject');
            $table->integer('score');
            $table->string('choose_A');
            $table->string('choose_B');
            $table->string('choose_C');
            $table->string('choose_D');
            $table->string('choose_E');
            $table->string('choose_F');
            $table->string('choose_G');
            $table->string('choose_right')->nullable();
            $table->string('analysis')->nullable();
            $table->integer('type')->nullable();
            $table->softDeletes();
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
        Schema::drop('questionDati');
    }
}
