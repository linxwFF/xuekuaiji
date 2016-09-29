<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\Models\QuestionDati;
use App\Repositories\Eloquent\QuestionDatiRepository as QuestionDatiRepo;
use App\Http\Requests\QuestionPostRequest;
use App\Models\Dict;
use Input;
use DB;
use Lang;
use Redirect;

class QuestionDatiManageController extends Controller
{
    protected $questionDatiRepo;

    public function __construct(QuestionDatiRepo $questionDatiRepo)
    {
        $this->questionDatiRepo = $questionDatiRepo;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.questions_dati_manage.index');
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

        $data = $this->questionDatiRepo->table($fields);
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

    public function create()
    {
        return view('admin.questions_dati_manage.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $result = $this->questionDatiRepo->store($input);  //新增大题
        return Redirect::to('admin/questionDatiManage')->with('status', $result['data']['message']);
    }

    public function edit($id)
    {
        $result = QuestionDati::find($id);
        $result_son = QuestionDati::where('f_id', $id)->get();

        $data['base']    =  $result ? $result->toArray() : null;       //基类大题
        $data['derived'] =  $result_son ? $result_son->toArray() : null;   //派生小题

        $data['base']['type_text'] = Dict::getTextByCodeValue('question_type', $result->type);  //题型

        foreach ($data['derived'] as $key => $value) {
            $data['derived'][$key]['choose_right_'.$key] = explode(',',$value['choose_right']); //转换多选情况
            $data['derived'][$key]['choose'] = array(
                'A' => $value['choose_A'],
                'B' => $value['choose_B'],
                'C' => $value['choose_C'],
                'D' => $value['choose_D'],
            );
        }
        // dd($data);
        return view('admin.questions_dati_manage.update')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        dd($input);
        // $result = $this->questionDatiRepo->update_one($input['form']);
        // return Response::json($result['data'], $result['status']);
    }

    public function destroy($id)
    {
        $result = $this->questionDatiRepo->destroy_one($id);
        return Response::json($result['data'], $result['status']);
    }

    public function destroy_many()
    {
        $input = Input::all();
        $result = $this->questionDatiRepo->destroy_many($input);
        return Response::json($result['data'], $result['status']);
    }
}
