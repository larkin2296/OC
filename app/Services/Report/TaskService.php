<?php 

namespace App\Services\Report;

use Yajra\DataTables\Html\Builder;
use DataTables;
use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use DB;
use App\Repositories\Criterias\OrderBySortCriteria;
use App\Repositories\Criterias\FilterCompanyIdCriteria;
use App\Repositories\Criterias\FilterByFieldCriteria;

class TaskService extends Service
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
            ['data' => 'report_first_received_date', 'name' => 'report_first_received_date', 'title' => '获知时间'],
            ['data' => 'drug_name', 'name' => 'drug_name', 'title' => '药物名称', 'class' => 'text-center'],
            ['data' => 'first_event_term', 'name' => 'first_event_term', 'title' => '不良事件'],
            ['data' => 'seriousness', 'name' => 'seriousness', 'title' => '严重性'],
            ['data' => 'standard_of_seriousness', 'name' => 'standard_of_seriousness', 'title' => '严重性标准'],
            ['data' => 'case_causality', 'name' => 'case_causality', 'title' => '因果关系'],
            ['data' => 'received_from_id', 'name' => 'received_from_id', 'title' => '首次/随访'],
            ['data' => 'task_user_name', 'name' => 'task_user_name', 'title' => '处理人'],
            ['data' => 'organize_role_name', 'name' => 'organize_role_name', 'title' => '任务进度'],
            ['data' => 'task_countdown', 'name' => 'task_countdown', 'title' => '任务倒计时'],
            ['data' => 'report_countdown', 'name' => 'report_countdown', 'title' => '报告倒计时'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作'],
        ])
       	->ajax([
			'url' => route('admin.report.task.index'),
		    'type' => 'GET',

       	])->parameters(config('back.datatables-cfg.basic'));


	    return [
	    	'html' => $html
	    ];
	}

	public function datatables()
	{
		/*公司id*/
		$companyId = getCompanyId();
		/*当前用户id*/
		$user = getUser();
		$roles = $user->roles;
		
		$userId = getUserId();

		$fields = ['id', 'report_id', 'report_identify', 'report_first_received_date', 'drug_name', 'first_event_term', 'seriousness', 'standard_of_seriousness', 'case_causality', 'received_from_id', 'task_user_name', 'organize_role_name', 'task_countdown', 'report_countdown', 'source_id'];

		/*查询的字段*/
		$searchFields = [
			'report_identify' => 'like',
			'drug_name' => 'like',
			'event_term' => 'like',
			'organize_role_id' => '=',
			'case_causality' => '=',
			'report_type' => '=',
			'task_user_id' => '=',
			'status' => '=',
		];
		/*获取查询条件*/
		$where = $this->searchArray($searchFields);
		/*获取数据*/
		$this->reportTaskRepo->pushCriteria(new OrderBySortCriteria('asc', 'task_countdown'));
		/*查询公司*/
		$this->reportTaskRepo->pushCriteria(new FilterCompanyIdCriteria($companyId));

		/*判断是否不是企业管理员*/
		if( !isCompanyManager($roles) ) {
			/*查询当前拥有者*/
			$this->reportTaskRepo->pushCriteria(new FilterByFieldCriteria('task_user_id', $userId));
		}
		$data = $this->reportTaskRepo->findWhere($where, $fields);

        return DataTables::of($data)
        			->editColumn('id', '{{$id_hash}}')
        			->editColumn('report_id', '{{ $report_id_hash }}')
        			->addColumn('action', getThemeTemplate('back.report.task.datatable'))
        			->editColumn('task_countdown', '{{ calcCarbonCountdown($task_countdown) }}')
        			->editColumn('report_countdown', '{{ calcCarbonCountdown($report_countdown) }}')
	        		->make();
	}
}