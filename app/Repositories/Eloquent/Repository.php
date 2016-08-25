<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseInterface;
// 模式基类
use Illuminate\Database\Eloquent\Model;
// 容器
use Illuminate\Container\Container as App;

abstract class Repository implements BaseInterface
{
    /*App容器*/
    protected $app;

    /*操作model*/
    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    // 创建指定的 model
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        /*是否是Model实例*/
        if (!$model instanceof Model){
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        $this->model = $model;
    }

    // 指定子类的model
    abstract function model();

    // 实现基类接口的方法
    // 获取所有用户信息
    public function allUsers()
    {
        return $this->model->all();
    }
}
