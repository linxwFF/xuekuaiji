<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Question;
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

    public function examDate()
    {
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
        $data = Question::get($fields);
        if ($data) {
            foreach ($data as $key => &$value) {
                // 选择题
                if ($value->type == 1) {
                    $result['type_1'][] = $value;
                }
                // 多选题
                if ($value->type == 2) {
                    $result['type_2'][] = $value;
                }
                // 判断题
                if ($value->type == 3) {
                    $result['type_3'][] = $value;
                }
                // 大题
                if ($value->type == 4) {
                    $result['type_4'][] = $value;
                }
            }

            $result['status'] = 200;
        } else {
            $result = '';
            $result['status'] = 302;
        }

        return view('before.exam')->with($result);

    }

}
