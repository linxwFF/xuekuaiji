<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  // 当前控制器名字
  protected function getControllerName()
  {
    $controller = get_class($this);
    $controller = substr($controller, 0, -10);
    $controller = str_replace('Http\\Controllers\\', '', $controller);
    // 控制器首字母大写
    $controller = studly_case($controller);

    return $controller;
  }

  // 获取控制器对应的Model
  protected function getModel()
  {
    $controller = get_class($this);
    $temp = substr($controller, 0, -10);
    $temp = str_replace('Http\\Controllers\\', 'Models\\', $temp);
    $temp = studly_case(str_singular($temp));
    return app($temp);
  }

  // 获取控制器对应的View名称
  protected function getViewName()
  {
    $exp = explode("\\", $this->getControllerName());
    return snake_case(end($exp));
  }
/*
  // 列表界面
  public function index()
  {
    if (empty($this->view_index)) {
      $this->view_index = $this->get_view();
    }

    return View::make($this->view_index)
      ->with('dicts', json_encode($this->get_dicts()))
      ->with('config', json_encode($this->get_config()))
      ->with('page_type', $this->page_type);
  }
*/
  // 获取列表数据
  public function table()
  {
    $result = $this->getModel()->table(Input::all());
    return Response::json($result['data'], $result['status']);
  }

  // 根据 id 查找数据
  public function find($id) {
    $result = $this->getModel()->find($id);
    return Response::json($result, 200);
  }

  // 新增一条数据
  public function storeOne()
  {
    $result = $this->getModel()->store_one(Input::all());
    return Response::json($result['data'], $result['status']);
  }

  // 更新一条数据
  public function updateOne()
  {
    $result = $this->getModel()->update_one(Input::all());
    return Response::json($result['data'], $result['status']);
  }

  // 删除一条数据
  public function destroyOne($id) {
    $result = $this->getModel()->destroy_one($id);
    return Response::json($result['data'], $result['status']);
  }

  // 批量删除数据
  public function destroyMany()
  {
    $result = $this->getModel()->destroy_many(Input::all());
    return Response::json($result['data'], $result['status']);
  }

  // 设置后台Layout
  protected function setupLayout()
  {
    if ( ! is_null($this->layout)) {
      $this->layout = View::make($this->layout);
    }
  }

    // 新的数据验证函数，保留旧的 validate() 方法避免出错
    public function validateArr($validatorArr, $input)
    {
        $result = true;

        $messages = array(
            'numeric'  => '错误的:attribute',
            'required' => '错误的:attribute',
            'between'  => ':attribute只能在:min到:max之间',
            'date_format' => '错误的日期格式',
            'in'  => '错误的:attribute',
            'digits_between' => '错误的:attribute',
        );

        foreach ($validatorArr as $key => $value) {
            if (!isset($input[$key])) {
                $input[$key]='';
            }

            $validator = Validator::make(
                array($value['alias'] => $input[$key]),
                array($value['alias'] => $value['rule']),
                $messages
            );

            // Log::info('当前验证：' . $value['alias'] . '。验证规则为：' . $value['rule'] . '。数据为：' . $input[$key]);
            if ($validator->fails()) {
                $result = array(
                    'message' => $validator->messages()->first(),
                    'status'  => Status::HTTP_BAD_REQUEST
                );
                break;
            }
        }

        return $result;
    }
}
