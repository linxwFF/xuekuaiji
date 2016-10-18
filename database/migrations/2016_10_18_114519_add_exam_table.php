<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            //小题  按照  课程 章  节
            $table->integer('course_type')->nullable()->after('id');
            $table->integer('z_id')->nullable()->after('id');
            $table->integer('j_id')->nullable()->after('id');
        });

        Schema::table('question_dati', function (Blueprint $table) {
            //大题  按照  课程 章  节
            $table->integer('course_type')->nullable()->after('id');
            $table->integer('z_id')->nullable()->after('id');
            $table->integer('j_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
            $table->dropColumn(['course_type', 'z_id' , 'j_id']);
        });

        Schema::table('question_dati', function (Blueprint $table) {
            //
            $table->dropColumn(['course_type', 'z_id' , 'j_id']);
        });
    }
}
