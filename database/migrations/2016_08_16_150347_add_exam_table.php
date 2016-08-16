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
        //选项表 增加试题解析字段
        Schema::table('options', function (Blueprint $table) {
            $table->string('analysis')->after('choose_right');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function(Blueprint $table)
		{
			$table->dropColumn('analysis');//
		});
    }
}
