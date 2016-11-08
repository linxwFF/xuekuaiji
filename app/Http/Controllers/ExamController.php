<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Auth;
use App\Models\Dict;

class ExamController extends Controller
{
    public function _construst()
    {
        $this->middleware('auth');
    }

    public function start_exam()
    {
        if(Auth::check()){
            $user = Auth::user();
            $result = [
                'username' => $user->username,
                'email'    => $user->email,
            ];
            return view("before.start_exam")->with($result);
        }else {
            // abort(403,'对不起，您无权访问该页面！');
            return redirect('/login');
        }
    }

    public function examDate(Request $request)
    {
        if(Auth::check()){
            $input = $request->all();
            $course_id = $input['course_id'];
            $takeNum = 10;
            $user = Auth::user();
            $fields = [
                'id',
                'subject',
                'score',
                'choose_A',
                'choose_B',
                'choose_C',
                'choose_D',
                'type',
            ];

            //随机取出10条
            $type_1 = Question::where('course_type', $course_id)->where('type','1')->orderBy(\DB::raw('RAND()'))->take($takeNum)->get($fields);
            $type_2 = Question::where('course_type', $course_id)->where('type','2')->orderBy(\DB::raw('RAND()'))->take($takeNum)->get($fields);
            $type_3 = Question::where('course_type', $course_id)->where('type','3')->orderBy(\DB::raw('RAND()'))->take($takeNum)->get($fields);

            $result = [
                'type_1'      => $type_1,
                'type_2'      => $type_2,
                'type_3'      => $type_3,

                'takeNum'     => $takeNum,     //题目数量
                'course_id'   => $course_id,  //科目ID
                'course_type' => Dict::getTextByCodeValue('course_type', $course_id),  //科目ID

                //用户信息
                'username'    => $user->username,
                'email'       => $user->email,

                'status'      => 200, //状态
            ];

            return view('before.exam')->with($result);
        } else {
            // abort(403,'对不起，您无权访问该页面！');
            return redirect('/login');
        }
    }

    public function handPaper(Request $request)
    {
        $input = $request->all();
        dd($input);
    }

}
