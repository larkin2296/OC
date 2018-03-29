<?php 

namespace App\Traits;

use Exception;

Trait ServiceTrait
{

	public function index()
	{
		return [];
	}

	public function create()
	{
		return [];
	}

	public function store()
	{
		return [];
	}

	public function show($id)
	{
		return [];
	}

	public function edit($id)
	{
		return [];
	}

	public function update($id)
	{
		return [];
	}

	/**
	 * 验证产品并返回，默认不能为空
	 * @param  [type]  $key     [description]
	 * @param  [type]  $default [description]
	 * @param  boolean $bool    [description]
	 * @return [type]           [description]
	 */
	public function checkParam($key, $default, $bool = true)
	{
		$val = request($key);

		if($bool) {
			if(!$val) {
				throw new Exception("参数不能为空", 2);
			}
		} else {
			$val = $val ?: $default;
		}

		return $val;
	}

	public function checkParamValue($val, $default, $bool = true)
	{
		if($bool) {
			if(!$val) {
				throw new Exception("参数不能为空", 2);
			}
		} else {
			$val = $val ?: $default;
		}

		return $val;
	}

	/**
	 * 获取请求中的参数的值
	 * @param  array  $fields [description]
	 * @return [type]         [description]
	 */
	public function searchArray($fields=[])
	{
		$results = [];
		if (is_array($fields)) {
			foreach($fields as $field => $operator) {
				if(request()->has($field) && $value = $this->checkParam($field, '', false)) {
					$results[$field] = [$field, $operator, "%{$value}%"];
				}
			}
		}

		return $results;
	}
	//获取config里面配置的查询字段和结果表的字段
	public function get_config_blade($arr){
	    //循环查询字段
        foreach($arr['query'] as &$value){
            //如果是select，匹配field里面的option
            if($value['type'] == 'select'){
                $url = 'oc.field.'.$value['name'];
                $value['option'] = config($url);
            }
        }
        //返回
        return $arr;
    }
}