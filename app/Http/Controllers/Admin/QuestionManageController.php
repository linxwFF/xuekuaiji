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
use DB;

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

    public function create()
    {
        $result = Dict::getByCodes([
            'question_type' => 'question_type',
        ]);

        return view('admin.questions_manage.create')->with('question_type', $result['question_type']);
    }

    public function store(QuestionPostRequest $request)
    {
        $input = $request->all();
        if(isset($input['choose_right']) &&  is_array($input['choose_right'])){
            $input['choose_right']  = implode(',',$input['choose_right']); //转换多选情况
        }
        $result = $this->questionRepo->store_one($input);
        return redirect('/admin/questionManage/create')->with('status', $result['data']['message']);
    }

    public function edit($id)
    {
        $result = Question::find($id);
        $data['id']             = $result->id;
        $data['f_id']           = $result->fid;
        $data['subject']        = $result->subject;
        $data['score']          = $result->score;
        $data['analysis']       = $result->analysis;
        $data['type']           = $result->type;
        $data['type_text'] = Dict::getTextByCodeValue('question_type', $result->type);

        if($result && $result->type == 1){   //单选题
                $temp['A'] = $result->choose_A;
                $temp['B'] = $result->choose_B;
                $temp['C'] = $result->choose_C;
                $temp['D'] = $result->choose_D;
                $data['choose'] = $temp;
                $data['choose_right']   = $result->choose_right;
        }elseif ($result && $result->type == 2) { //多选题
            $temp['A'] = $result->choose_A;
            $temp['B'] = $result->choose_B;
            $temp['C'] = $result->choose_C;
            $temp['D'] = $result->choose_D;
            $temp['E'] = $result->choose_E;
            $temp['F'] = $result->choose_F;
            $temp['G'] = $result->choose_G;
            $data['choose'] = $temp;
            $data['choose_right']   = explode(',', $result->choose_right);
        }elseif ($result && $result->type == 3) { //判断题
            $temp = array();
            $data['choose'] = $temp;
            $data['choose_right']   = $result->choose_right;
        }

        return view('admin.questions_manage.update')->with('data', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $result = $this->questionRepo->update_one($input['form']);
        return Response::json($result['data'], $result['status']);
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
