<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dict extends Model
{
    protected $search_fields =  array('code', 'code_name', 'text', 'remark');

    static public function getByCode($code) {
        return Dict::where('code', '=', $code)->where('value', '>', '0')->get();
    }

    // 读一次表获取多个代码
    static public function getByCodes($codes) {
        // 获取所有codes数据
        $list = Dict::where(function($query) use($codes) {
         if (is_array($codes)) {
           // 是数组则遍历
           foreach ($codes as $code) {
             $query = $query->orWhere('code', $code);
           }
         }
        });
        $items = $list->get()->toArray();

        // 遍历排除value=0的数据，并按$codes数组中的$key值分类
        $result = [];
        foreach ($items as $key => $value) {
         foreach ($codes as $name => $code) {
           if ($value['code'] === $code && $value['value'] > 0) {
             if (empty($result[$name])) {
               $result[$name] = [];
             }
             array_push($result[$name], $value);
             break;
           }
         }
        }

        return $result;
    }

    /**
      * [根据code 和 value 获取text]
      */
     static public function getTextByCodeValue($code, $value=null) {
       if($value) {
         $item = Dict::where('code', '=', $code)->where('value', $value)->first();
         if(!empty($item)) {
           return $item->text;
         }
       }
       return null;
     }
}
