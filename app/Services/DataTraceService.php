<?php 

namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

class DataTraceService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait;

	public function __construct(Builder $builder)
	{
		parent::__construct();
		$this->builder = $builder;
	}
	public function index()
	{
	    $html = $this->builder->columns([
            ['data' => 'report_identify', 'name' => 'report_identify', 'title' => '报告编号'],
            ['data' => 'report_tab_id', 'name' => 'report_tab_id', 'title' => '页'],
            ['data' => 'field', 'name' => 'field', 'title' => '字段', 'class' => 'text-center'],
            ['data' => 'old_value', 'name' => 'old_value', 'title' => '旧值'],
            ['data' => 'new_value', 'name' => 'new_value', 'title' => '新值'],
            ['data' => 'action_status', 'name' => 'action_status', 'title' => '操作状态'],
            ['data' => 'action_description', 'name' => 'action_description', 'title' => '操作说明'],
            ['data' => 'user_name', 'name' => 'user_name', 'title' => '操作人'],
            ['data' => 'user_role', 'name' => 'user_role', 'title' => '操作人角色'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => '操作时间'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => '创建时间'],
        ])
       	->ajax([
			'url' => route('admin.datatrace.index'),
		    'type' => 'GET',

       	])->parameters(config('back.datatables-cfg.basic'));


	    return [
	    	'html' => $html
	    ];
	}

	public function datatables()
	{
		$data = $this->dataTraceRepo->all(['report_identify', 'report_tab_id', 'field', 'old_value', 'new_value', 'action_status', 'action_description', 'user_name', 'user_role', 'updated_at', 'created_at']);

        return DataTables::of($data)->make();
	}
}