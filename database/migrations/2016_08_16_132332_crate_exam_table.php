<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //题目表
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subject');
            $table->integer('score')->nullable();
            $table->integer('options_id');
            $table->softDeletes();
            $table->timestamps();
        });
        //选项表
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('choose_A');
            $table->string('choose_B');
            $table->string('choose_C');
            $table->string('choose_D');
            $table->string('choose_E');
            $table->string('choose_F');
            $table->string('choose_G');
            $table->integer('questions_id');
            $table->string('choose_right');
            $table->softDeletes();
            $table->timestamps();
        });
        //题库表
        Schema::create('question_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('questions_id');
            $table->integer('type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        //考卷表
        Schema::create('papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('questions_papers_id');
            $table->integer('type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        //答题中间表
        Schema::create('questions_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('radio')->nullable();
            $table->text('checkbox')->nullable();
            $table->text('judge')->nullable();
            $table->text('points')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        //答卷表
        Schema::create('answer_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('papers_id')->nullable();
            $table->text('answers')->nullable();
            $table->text('users_id')->nullable();
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
        Schema::drop('questions');
        Schema::drop('options');
        Schema::drop('question_banks');
        Schema::drop('papers');
        Schema::drop('questions_papers');
        Schema::drop('answer_papers');
    }
}
