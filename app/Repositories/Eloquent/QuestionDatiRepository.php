<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use App\Models\QuestionDati;
use DB;
use Lang;

class QuestionDatiRepository extends Repository
{
	// 实现抽象类的方法  返回一个UserModel对象实例
    public function model()
    {
        return QuestionDati::class;
    }

    // 以下可以重新基类方法
    // 获取所有的数据
    public function table($fields)
    {
        $model = $this->model();
        $list = $model::select($fields)->where('f_id','0')->orderBy('id','desc')->get()->toArray();
        $result = [
            'data' => $list
        ];
        return $result;
    }

    //添加大题
    public function store($input)
    {
        $bigSubject = array(
             '_token'  => $input['_token'],
             'subject'  => $input['subject'],
             'score'   => $input['score'] ,
             'type'    => $input['type']
         );
        $result = array('status' => 404, 'data' => Lang::get('messages.stored_failed'));
        if (!empty($bigSubject)) {
                DB::beginTransaction();
        try {
        $result = $this->store_one($bigSubject);
        $fid = $result['data']['item']['id'];

        //小题信息序列化
        foreach ($input['subject_'] as $key => $value) {
            $data[$key]['_token'] = $input['_token'];
            $data[$key]['f_id'] = $fid;
            $data[$key]['subject']      = $input['subject_'][$key];
            $data[$key]['choose_A']     = $input['choose_A'][$key];
            $data[$key]['choose_B']     = $input['choose_B'][$key];
            $data[$key]['choose_C']     = $input['choose_C'][$key];
            $data[$key]['choose_D']     = $input['choose_D'][$key];
            $data[$key]['score']        = $input['score_'][$key];
            $data[$key]['type']         =  4;
            $data[$key]['choose_right'] = implode(",", $input['choose_right'][$key][$key]);
            $data[$key]['analysis']     = $input['analysis'][$key];
        }

        foreach ($data as $value) {
            $result = $this->store_one($value);
        }

        } catch (Exception $e) {
          DB::rollback();
          return [
            'status' => $e->getCode(),
            'data' => ['message' => "保存失败！". $e->getMessage()]
          ];
        }
          DB::commit();
          return $result;
        }
        return $result;
    }
}
