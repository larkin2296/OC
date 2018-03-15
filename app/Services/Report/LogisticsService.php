<?php
/**
 * Created by PhpStorm.
 * User: lvxinxin
 * Date: 2018/02/05
 * Email: 1009@maschen.cc
 */

namespace App\Services\Report;

use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use DB;
use App\Services\Service;
class LogisticsService extends Service{
    use ServiceTrait,ResultTrait,ExceptionTrait;
    protected $builder;
    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function lists($report_identifier){
        try{
            if (!$report_identifier) throw new Exception('参数为空');
            return $this->logisticsRepo->getLists($report_identifier);
        }
        catch (Exception $e){
            \Log::error(__METHOD__,[$e->getMessage()]);
            return false;
        }
    }

    public function create()
    {
        #上报监管-添加-物流公司
        $logistics_company = [];

        return [
            'logistics_company' => $logistics_company,
        ];
    }

    public function store()
    {
        $data = request()->all();
        $data['company_id'] = getCompanyId() ;
        #TODO::研究方案编号  即当前的项目编号
        #$data['solution_number'] = '';
        try {
            $exception = DB::transaction(function () use ($data) {

                if ($logistics = $this->logisticsRepo->create($data)) {
                    # TODO:: exec other logic
                } else {
                    throw new Exception(trans('code/logistics.store.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/logistics.store.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/logistics.store.fail')),
            ]);
        }
        return array_merge($this->results, $exception);

    }

    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function () use ($id) {
                $id = $this->logisticsRepo->decodeId($id);
                #删除

                if ($source = $this->logisticsRepo->update(['status' => 2], $id)) {
                    #TODO:: other logic
                } else {
                    throw new Exception(trans('code/logistics.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/logistics.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/logistics.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
}