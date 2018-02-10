<?php
namespace App\Services\Report;
use Yajra\DataTables\Html\Builder;
use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\DictionariesTrait;
use App\Traits\Services\Report\MainTrait;
use App\Events\Report\Main;
use Exception;
use DB;
use DataTables;
class MainpageService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait,DictionariesTrait,MainTrait;
    protected $builder;
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function datatables($source_id)
    {
       $field = ['id','report_first_received_date','report_drug_safety_date','aecountry_id','aecountrys_id','aecountry','received_fromid_id','received_fromids_id','received_from_id','research_id','center_number','delayedreason','brand_name','generic_name','event_term','seriousness','event_of_onset','report_identifier','report_type','reporter_name','reporter_organisation','reporter_department','reporter_country','reporter_country_id','reporter_countries_id','reporter_stateor_province','reporter_city','reporter_post','reporter_telephone_number','patient_name','subject_number','date_of_birth','age','age_at_timeofonsetunit','sex','patient_contact_information','literature_publishedyear','literature_author','literature_published_journals','status_type','literature_title','time_begin','time_end','severity'];
       $searchFields = [
           'report_first_received_date' => 'like',
           'report_drug_safety_date' => 'like',
           'aecountry_id' => '=',
           'received_fromid_id' => '=',
           'research_id' => 'like',
           'center_number' => 'like',
           'delayed_reason' => 'like',
           'severity'=> '=',
           'brand_name' => 'like',
           'generic_name' => 'like',
           'event_term' => 'like',
           'first_brand_name'=>'like',
           'seriousness' => '=',
           'event_of_onset' => '=',
           'reporter_name' => 'like',
           'reporter_organisation' => 'like',
           'reporter_department' => 'like',
           'reporter_country_id' => '=',
           'reporter_stateor_province' => 'like',
           'reporter_city' => 'like',
           'reporter_post' => 'like',
           'reporter_telephone_number' => 'like',
           'patient_name' => 'like',
           'subject_number' => 'like',
           'date_of_birth' => '=',
           'age' => '=',
           'age_at_timeofonsetunit' => '=',
           'sex' => '=',
           'role_organize_status'=> '=',
           'patient_contact_information' => '=',
           'literature_published_year' => 'like',
           'literature_author' => 'like',
           'literature_published_journals' => 'like',
           'literature_title' => 'like',
       ];

        $user = getUser();

        $userNowId = $user->id;
        /*当前用户的权限 如果包含数据录入员（ 2 ）显示新建 按钮*/
        $organizeRoleIds = $user->roles->keyBy('organize_role_id')->keys()->toArray();
        /*获取查询条件*/
        $where = $this->searchArray($searchFields);

        $allData = $this->reportMainpageRepo->findWhere($where)->all();

        return DataTables::of($allData)
            ->addColumn('organizeRoleIds', $organizeRoleIds)
            ->addColumn('source_id', $source_id)
            ->addColumn('action', getThemeTemplate('back.report.mainpage.datatables'))
            ->addColumn('role_organize_status', getThemeTemplate('back.report.mainpage.status'))
            ->removeColumn('organizeRoleIds')
            ->removeColumn('source_id')
            ->make();
    }
    public function index()
    {
        $html = $this->builder->columns([
            ['data' => 'report_first_received_date', 'name' => 'report_first_received_date', 'title' => '首次获悉的时间'],
            ['data' => 'report_drug_safety_date', 'name' => 'report_drug_safety_date', 'title' => 'pv获悉的时间'],
            ['data' => 'research_id', 'name' => 'research_id', 'title' => '项目编号'],
            ['data' => 'center_number', 'name' => 'center_number', 'title' => '中心编号'],
            ['data' => 'event_term', 'name' => 'event_term', 'title' => '不良事件'],
            ['data' => 'first_drug_name', 'name' => 'first_drug_name', 'title' => '药品名称'],
            ['data' => 'report_identifier', 'name' => 'report_identifier', 'title' => '报告编号'],
            ['data' => 'received_from_id', 'name' => 'received_from_id', 'title' => '报告类型'],
            ['data' => 'patient_name', 'name' => 'patient_name', 'title' => '患者姓名'],
            ['data' => 'subject_number', 'name' => 'subject_number', 'title' => '患者编号'],
            ['data' => 'role_organize_status', 'name' => 'role_organize_status', 'title' => '当前的状态  与角色权限所关联 2：数据录入3：数据质控qc4：医学评审5：医学审评QC6：已完成'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
        ])
            ->ajax([
                'url' => route('admin.report.mainpage.index'),
                'type' => 'GET',
            ]);
        return [
            'html' => $html
        ];

    }
    /*新建报告*/
    public function create()
    {
        try {
            $exception = DB::transaction(function(){
                /*获取原始资料id*/
                $sourceId = request('source_id', '');
                //获取当前登录用户id
                $user = getUser();
                $user_id = $user->id;
                $company = $user->company;
                //判断当前报告是否首次商品名称
                $companyName = $company->name;

                $companyId = $company->id;

                $companyId = getCompanyId();

                $report_identifier = $this->getReportNumber($companyName,$companyId);

                $infoResults = request()->all();
                $report_identifier = $this->getReportNumber($companyName,$companyId);
                if($this->reportMainpageRepo->findWhere(['company_id'=>$companyId])){$infoResults['is_first_report']=1;};
                $infoResults['report_identifier'] = $report_identifier;
                $infoResults['company_id'] = $companyId;
                $infoResults['source_id']= $sourceId;
                $infoResults['user_id']=$user_id;
                $infoResults['drug_name'] = $infoResults['brand_name'].'/'.$infoResults['generic_name'];
                //获取规则 找到当前规则id
                $severity=request()->severity;

                $regulationInfo=$this->regulaRepo->getRegulationsBySeverity($companyId, $severity);

                $regulation_id = $regulationInfo->id;
                $infoResults['regulation_id']=$regulation_id;
                $Information = $this->reportMainpageRepo->create($infoResults);
                if($Information) {

                    $id = $Information->id;

                    $report = $this->reportMainpageRepo->find($id);

//                    //数据推送到Tab数据表
                    event(new \App\Events\Report\Task\Create($report,$companyId,$regulationInfo,$user_id));
//                    //数据推送

                    if($sourceId) {
                        //设置报告任务数据
                        event(new \App\Events\Report\Task\Update($report, $companyId,$regulationInfo, $sourceId));
                    } else {
                        //创建报告任务
                        event(new \App\Events\Report\Task\Create($report,$companyId,$regulationInfo,$user_id));
                    }
                    //数据推送

                    event(new \App\Events\Report\Value\Create($report));

                } else {
                    throw new Exception(trans('code/mainpage.create.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'data'=>$Information,
                    'message' => trans('code/mainpage.create.success'),
                ]);
            });
        } catch (Exception $e) {
            dd($e);
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/mainpage.create.fail')),
            ]);
        }

        return array_merge($this->results, $exception);

    }
    /*复制*/
    public function copyData($id)
    {
        try {
            $exception = DB::transaction(function() use ($id){
                //获取当前登录用户id
                $user = getUser();

                $user_id = $user->id;

                $company = $user->company;

                $companyName = $company->name;

                $companyId = $company->id;

                $report_identifier = $this->getReportNumber($companyName,$companyId);

                $infoResults = $this->reportMainpageRepo->find($id)->toArray();

                $infoResults['report_identifier'] = $report_identifier;$infoResults['is_first_report']=1;

                $infoResults['company_id'] = $companyId;

                $infoResults['user_id'] = $user_id;

                $regulation_id = $infoResults['regulation_id'];

                if($Information = $this->reportMainpageRepo->create($infoResults)) {

                    $id = $Information->id;

                    $report = $this->reportMainpageRepo->find($id);
                    //数据推送到Tab数据表
                    event(new \App\Events\Report\Task\Create($report,$companyId,$regulation_id,$user_id));
                    //数据推送
                    event(new \App\Events\Report\Value\Create($report));
                } else {
                    throw new Exception(trans('code/mainpage.copydata.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'data'=>$Information,
                    'message' => trans('code/mainpage.copydata.success'),
                ]);
            });
        } catch (Exception $e) {
            dd($e);
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/mainpage.copydata.fail')),
            ]);
        }

        return array_merge($this->results, $exception);

    }
    /*隐藏  *删除*/
    public function edit($id)
    {
        // event(new \App\Events\Report\Main\PushReportEvent(null,null,null,null));
        // dd(__LINE__);

        $exception = DB::transaction(function() use ($id) {
            $user = getUser();
            $user_id = $user->id;
            if(1) {
                $report_identifier = '2018MSYX000001';
                $report_first_received_date='2018/2/5';
                $report_drug_safety_date='2018/2/5';
                $create_version_cause='1';
//                    event(new \App\Events\Report\Value\SetRedundanceData(null, null, null));
                event(new \App\Events\Report\Main\PushReportEvent($report_identifier, $report_first_received_date, $report_drug_safety_date, $create_version_cause));
                // dd(__LINE__);
            } else {
                throw new Exception(trans('code/mainpage.delete.fail'), 2);
            }

            return array_merge($this->results, [
                'result' => true,
                'message' => trans('code/mainpage.delete.success'),
            ]);
        });

//        $report_identifier = '2018MSYX000001';
//        $report_first_received_date='2018/2/5';
//        $report_drug_safety_date='2018/2/5';
//        $create_version_cause='1';
//        event(new \App\Events\Report\Main\PushReportEvent($report_identifier,$report_first_received_date,$report_drug_safety_date,$create_version_cause));
//        dd(__LINE__);

        try {
            $exception = DB::transaction(function() use ($id) {
                $user = getUser();
                $user_id = $user->id;
                if(1) {
//                    $report_identifier = '2018MSYX000001';
//                    $report_first_received_date='2018/2/5';
//                    $report_drug_safety_date='2018/2/5';
//                    $create_version_cause='1';
//                    event(new \App\Events\Report\Value\SetRedundanceData(null, null, null));
//                    event(new \App\Events\Report\Main\PushReportEvent(null,null,null,null));
//                    dd(__LINE__);
                } else {
                    throw new Exception(trans('code/mainpage.delete.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/mainpage.delete.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/mainpage.delete.fail')),
            ]);
        }

        return array_merge($this->results, $exception);

    }
    /*新建版本*/
    public function newReport($data)
    {
        try{
            $exception = DB::transaction(function() use ($data){
                //获取当前登录用户id
                $user = getUser();
                $user_id = $user->id;
                $company = $user->company;
                if(is_array($data)){
                 $company_id = $this->reportMainpageRepo->findWhere(['report_identifier'=>$data['report_identifier']])->pluck('company_id');

                 $report = $this->getReport($company,$user_id,$company_id);

                $report['create_version_cause'] = $data['create_version_cause'];

                $report['report_first_received_date'] = $data['report_first_received_date'];

                $report['report_drug_safety_date'] = $data['report_drug_safety_date'];

                $information = $this->reportMainpageRepo->create($report);

//                    /*复制报告任务*/
//                    event(new \App\Events\Report\Task\Copy($reportId, $taskUserId, $regulation, $reportFirstReceivedData, $newReport));
//                    event(new \App\Events\Report\Value\Copy($reportId, $newReport));

                }else {
                    $report_identifier = $this->reportMainpageRepo->findWhere(['id'=>$data])->pluck('report_identifier');

                    $company_id = $this->reportMainpageRepo->findWhere(['report_identifier'=>$report_identifier])->pluck('company_id');

                    $report = $this->getReport($company,$user_id,$company_id);

                    $information = $this->reportMainpageRepo->create($report);
                }
                if($information){
                } else{
                    throw new Exception(trans('code/mainpage.newreport.fail'),2);
                }
                return array_merge($this->results, [
                    'result' => true,
                    'data'=>$information,
                    'message' => trans('code/mainpage.newreport.success'),
                ]);
            });
        } catch(Exception $e){
            $exception = array_merge($this->results, [
               'result' => false,
                'message' => $this->handler($e, trans('code/mainpage.newreport.fail')),
            ]);
        }
        return array_merge($this->results, $exception);

    }

    public function getReport($company,$user_id,$company_id)
    {
        //当前所有的编号
        $reportSome = $this->reportMainpageRepo->findWhere(['company_id'=>$company_id])->pluck('report_identifier');

        foreach($reportSome as $key=>$item){

            if(substr($item,0,strrpos($item,'-'))){

                $id = $this->reportMainpageRepo->findWhere(['report_identifier'=>$item])->pluck('id');
            }
        }
        $company_now_id = $company->id;
        $report = $this->reportMainpageRepo->find($id)->toArray();$report = $report[0];
        $report['user_id'] = $user_id;$report_identifier = $report['report_identifier'];
        $versionName = $this->getEdition($report_identifier,$company_now_id);
        $report['report_identifier'] = $versionName;$report['report_identifier_status']=1;
        return $report;
    }
    /*关联*/
    public function relation()
    {
        #TODO 通过报告编号获取最新一条报告 并 关联到当前的数据上  关联事件
        try {
            $exception = DB::transaction(function(){

                if(1) {
//                 $report_identifier = '2018MSYX000001';
//                 $report_first_received_date='2018/2/5';
//                 $report_drug_safety_date='2018/2/5';
//                 $create_version_cause='1';
//                 event(new \App\Events\Report\Main\PushReportEvent($report_identifier,$report_first_received_date,$report_drug_safety_date,$create_version_cause));
                     $sourceId = '';
                    event(new \App\Events\Report\Task\Delete($sourceId));
                } else {
                    throw new Exception(trans('code/mainpage.delete.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/mainpage.delete.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/mainpage.delete.fail')),
            ]);
        }

        return array_merge($this->results, $exception);

    }

}