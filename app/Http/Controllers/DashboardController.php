<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Question;
use Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            return view('before.dashboard');

        } else {
            return redirect('/login');
        }

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
