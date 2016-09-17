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

        dd($request->all());

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
