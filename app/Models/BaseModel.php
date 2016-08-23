<?php namespace App\Models;

use App\Exceptions\RestException as Exception;
use DB;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Config;
use Log;
use App;
use Validator;
use Lang;
use Symfony\Component\HttpFoundation\Response as Error;

class BaseModel extends Eloquent {
  use SoftDeletes;

  protected $search_fields;
  protected $search_condition = [];
  protected $order_by = 'id';
  protected $order_seq = 'desc';
  protected $per_page;

  public function __construct() {
    parent::__construct();
    $this->per_page = Config::get('app.per_page');
  }

  protected function get_model() {
      return App::make(get_called_class());
  }

  /**
   * 获取列表数据
   *
   * @param array $input
   * @param closure $callback
   * @return array
   *
   * @example
   *     $model->table($input, function($query) {
   *          if ($every_thing_is_ok) {
   *              return $query->where('name', 'foobar');
   *          }
   *          throw new Exception('Some thing wrong!', error_code);
   *     });
   */
  public function table($input, $callback = null) {
    $model = $this->get_model();
    $result = [];

    if (empty($input['keyword']) || empty($model->search_fields)) {
      // 获取所有数据

      if ($callback) {
        try {
          $list = $callback($model);
        } catch (Exception $e) {
          return [
            'status' => $e->geCode(),
            'data' => ['message' => '查询失败！' . $e->getMessage()]
          ];
        }
      } else {
        $list = $model;
      }
    } else {
      // 按查询条件获取数据
      $keyword = $input['keyword'];
      $fields = $model->search_fields;

      $list = $model::where(function($query) use($fields, $keyword) {
        if (is_array($fields)) {
          // 是数组则遍历
          foreach ($fields as $field) {
            $query = $query->orWhere($field, 'like', '%' . $keyword . '%');
          }
        } else {
          $query = $query->where($fields, 'like', '%' . $keyword . '%');
        }
      });

      if ($callback) {
        try {
          $list = $callback($list);
        } catch (Exception $e) {
          return [
            'status' => $e->getCode(),
            'data' => ['message' => '查询失败！' . $e->getMessage()]
          ];
        }
      }
    }

    $list = $list->orderby($model->order_by, $model->order_seq)->paginate($model->per_page);

    $result['status'] = 200;
    $result['data']['table'] = $list->toArray();

    if (!empty($input['keyword'])) {
      $result['data']['search_condition']['keyword'] = $input['keyword'];
    }

    return $result;
  }

  /**
   * 新增一条数据
   *
   * @param array $input
   * @param closure $callback
   * @return array
   *
   * @example
   *     $model->store_one($input, function($modelObj) {
   *          if ($every_thing_is_ok) {
   *              return;
   *          }
   *          throw new Exception('Some thing wrong!', error_code);
   *     });
   */
  public function store_one($input, $callback = null) {
		$model = $this->get_model();
		$item = new $model;

		foreach ($input as $key => $value) {
			if ($key != '_token') {
				$item->$key = $value;
			}

        }

        if ($callback) {
          try {
            $callback($item);
          } catch (Exception $e){
            return [
              'status' => $e->getCode(),
              'data' => ['message' => '保存失败！' . $e->getMessage()]
            ];
          }
        }

		$item->save();

		// $search_fields = $model->search_fields;
		// AdminLog::write(Auth::user()->username, $model->title . '添加' . $model->search_fields . '=' . $item->$search_fields, Request::getClientIp(), date('Y-m-d H:i:s', time()));

    $result = [];
    $result['status'] = Error::HTTP_CREATED;
    $result['data']['message'] = Lang::get('messages.stored');
    $result['data']['item'] = array('id' => $item['id'], 'created_at' => $item['created_at'], 'updated_at' => $item['updated_at']);

		return $result;
	}

  /**
   * 更新一条数据
   *
   * @param array $input
   * @param closure $callback
   * @return array
   *
   * @example
   *     $model->update_one($input, function($modelObj) {
   *          if ($every_thing_is_ok) {
   *              return;
   *          }
   *          throw new Exception('Some thing wrong!', error_code);
   *     });
   */
  public function update_one($input, $callback = null) {
    $model = $this->get_model();
    $result = array('code' => -1, 'desc' => '更新失败！！');

    if (!empty($input['id'])) {
      $item = $model::find($input['id']);

      if ($callback) {
        try {
          $callback($item);
        } catch (Exception $e){
          return [
            'status' => $e->getCode(),
            'data' => ['message' => '更新失败！' . $e->getMessage()]
          ];
        }
      }

      foreach ($input as $key => $value) {
        if ($key != '_token') {
          $item->$key = $value;
        }
      }

      $item->save();

      // $search_fields = $model->search_fields;
      // AdminLog::write(Auth::user()->username, $model->title . '编辑' . $model->search_fields . '=' . $item->$search_fields, Request::getClientIp(), date('Y-m-d H:i:s', time()));
      $result = [];
      $result['status'] = Error::HTTP_ACCEPTED;
      $result['data']['message'] = Lang::get('messages.updated');
      $result['data']['item'] = array('id' => $item['id'], 'updated_at' => $item['updated_at']);
    }

    return $result;
    }

  // 删除一条数据
  public function destroy_one($id, $callback = null) {
    $model = $this->get_model();
    $result = [];

    if (!empty($id) && $id > 0) {
      $item = $model::find($id);

      if ($callback) {
        try {
          $callback($item);
        } catch (Exception  $e) {
          return [
            'status' => $e->getCode(),
            'data' => ['message' => $e->getMessage()]
          ];
        }
      }

      $item->delete();
      // $search_fields = $this->search_fields;
      // AdminLog::write(Auth::user()->username, $this->title . '删除 id=' . $id, Request::getClientIp(), date('Y-m-d H:i:s', time()));

      $result['status'] = Error::HTTP_ACCEPTED;
      $result['data']['message'] = Lang::get('messages.deleted');
    } else {
      $result['status'] = Error::HTTP_NOT_FOUND;
      $result['data']['message'] = Lang::get('messages.delete_failed_404');
    }

    return $result;
  }

  // 批量删除
  public function destroy_many($input, $callback = null) {
    $model = $this->get_model();
    $items = $model::whereIn('id', $input['items']);

    if ($callback) {
      try {
        $callback($items->get());
      } catch (Exception  $e) {
        return [
          'status' => $e->getCode(),
          'data' => ['message' => $e->getMessage()]
        ];
      }
    }

    $items->delete();

    // $search_fields = $this->search_fields;
    // AdminLog::write(Auth::user()->username, $this->title . '删除 id=' . implode(",", $id), Request::getClientIp(), date('Y-m-d H:i:s', time()));

    $result = [];
    $result['status'] = 202;
    $result['data']['message'] = '删除成功！';

    return $result;
  }

  // 验证数据，验证规则参考larave手册
  public function validate($validator_arr, $input) {
    $result = true;

    foreach ($validator_arr as $key => $value) {

      if (!isset($input[$key])) {
        $input[$key]='';
      }

      $validator = Validator::make(
        array($value['alias'] => $input[$key]),
        array($value['alias'] => $value['rule']),
        Lang::get('validation.messages')
      );

      // Log::info('当前验证：' . $value['alias'] . '。验证规则为：' . $value['rule'] . '。数据为：' . $input[$key]);
      if ($validator->fails()) {
        $result = $validator->messages()->first();
        break;
      }
    }

    return $result;
  }

  // 不是当前用户的数据
  public function isBelongtoUser($admin_user_id, $id) {
    $result = true;
    $item = $this->where('admin_user_id', $admin_user_id)->where('id', $id)->first();

    if (!$item) {
      $result = false;
    }

    return $result;
  }

  // 是否存在
  public function isExist($id){
    $result = true;

    if (empty($id) || !is_numeric($id) || !$this->whereNull('deleted_at')->find($id)) {
      $result = false;
    }

    return $result;
  }

}
