<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Question;
use App\Repositories\Eloquent\QuestionRepository as QuestionRepo;
use App\Http\Requests\QuestionPostRequest;
use App\Models\Dict;
use Input;

class QuestionManageController extends Controller
{
    protected $questionRepo;

    public function __construct(QuestionRepo $questionRepo)
    {
        $this->questionRepo = $questionRepo;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.questions_manage.index');
    }


    public function table()
    {
        $fields = [
            'id',
            'subject',
            'score',
            'type',
            'created_at'
        ];

        $data = $this->questionRepo->table($fields);
        // //请求次数
        // $draw = request('draw', 1);
        //
        // $result = [
        //     'draw' => $draw,
        //     'recordsTotal' => 10,
        //     'recordsFiltered' => 10,
        //     'data' => $data,
        // ];

        return Response::json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = Dict::getByCodes([
            'question_type' => 'question_type',
        ]);

        return view('admin.questions_manage.create')->with('question_type', $result['question_type']);
    }

    public function createDati()
    {
        return view('admin.questions_manage.createDati');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionPostRequest $request)
    {
        $input = $request->all();
        if(isset($input['choose_right']) &&  is_array($input['choose_right'])){
            $input['choose_right']  = implode(',',$input['choose_right']); //转换多选情况
        }
        $result = $this->questionRepo->store_one($input);
        return redirect('/admin/questionManage/create')->with('status', $result['data']['message']);
    }

    public function storeDati(Request $request)
    {

        dd($request->all());

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Question::find($id);
        return view('admin.questions_manage.detail')->with('data', $data);
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

    public function destroy($id)
    {
        $result = $this->questionRepo->destroy_one($id);
        return Response::json($result['data'], $result['status']);
    }

    public function destroy_many()
    {
        $input = Input::all();
        $result = $this->questionRepo->destroy_many($input);
        return Response::json($result['data'], $result['status']);
    }
}
