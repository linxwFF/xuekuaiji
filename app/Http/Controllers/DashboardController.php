<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Response;
use App\Repositories\Eloquent\UserRepository as UserRepo;
use Crypt;


class DashboardController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->middleware('auth');
    }

    public function index()
    {

        return view('before.dashboard');

    }


    // 章节练习
    public function chapter_practice()
    {
        return view("before.chapter_practice");
    }

    //大题练习
    public function dati_practice()
    {
        return view("before.dati_practice");
    }

    //考前冲刺
    public function sprint_test()
    {
        return view("before.sprint_test");
    }

    //视频
    public function video()
    {
        return view("before.video");
    }

    //考试大纲
    public function test_syllabus()
    {
        return view("before.test_syllabus");
    }

    //帐号管理
    public function accounts_manage()
    {
        return view("before.accounts_manage");
    }

    //常见问题
    public function question()
    {
        return view("before.question");
    }

}
