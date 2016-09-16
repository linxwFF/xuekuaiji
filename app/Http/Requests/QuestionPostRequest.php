<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestionPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    //验证规则
    public function rules()
    {
        return [
            'subject' => 'required',
            'score' => 'required|numeric|digits:1',
            'type' => 'required|numeric|digits:1',
            'choose_right' => 'required',
            'analysis' => 'required',
        ];
    }

    //验证信息
    public function messages()
    {
        return [
            'subject.required' => '题目为必填项',
            'score.required' => '分数为必填项',
            'type.required' => '题目类型为必填项',
            'choose_right.required' => '正确选项为必填项',
            'analysis.required' => '答案解析为必填项',
            'score.numeric' => '分数输入有误',
            'type.numeric' => '题目类型输入有误',
            'score.digits' => '分数输入有误',
            'type.digits' => '题目类型输入有误',
        ];
    }
}
