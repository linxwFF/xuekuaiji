<?php

use Illuminate\Database\Seeder;
use App\Models\Dict;

class DictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = array(

        // 性别
        array ('code' => 'question_type', 'code_name' => '题型', 'value' => 0, 'text' => ''),
        array ('code' => 'question_type', 'code_name' => '题型', 'value' => 1, 'text' => '单选题'),
        array ('code' => 'question_type', 'code_name' => '题型', 'value' => 2, 'text' => '多选题'),
        array ('code' => 'question_type', 'code_name' => '题型', 'value' => 3, 'text' => '判断题'),
        array ('code' => 'question_type', 'code_name' => '题型', 'value' => 4, 'text' => '大题'),

        // 科目
        array ('code' => 'course_type', 'code_name' => '会计科目', 'value' => 0, 'text' => ''),
        array ('code' => 'course_type', 'code_name' => '会计科目', 'value' => 1, 'text' => '财经法规与会计职业道德'),
        array ('code' => 'course_type', 'code_name' => '会计科目', 'value' => 2, 'text' => '会计电算化'),
        array ('code' => 'course_type', 'code_name' => '会计科目', 'value' => 3, 'text' => '会计基础'),

        );

        foreach($arr as $a) {
          if (!Dict::where('code', $a['code'])->where('value', $a['value'])->first()) {
                $dict = new Dict;
                $dict->code = $a['code'];
                $dict->code_name = $a['code_name'];
                $dict->value = $a['value'];
                $dict->text = $a['text'];
                if (!empty($a['remarks'])) {
                  $dict->remarks = $a['remarks'];
                }
                $dict->save();
          }
        }

    }
}
