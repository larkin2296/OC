<?php
namespace App\Services\OcService;
use App\Services\Service as BasicService;

use Mockery\Exception;
use Yajra\DataTables\Html\Builder;
use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DB;
use DataTables;


class SupplierListService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function datatables()
    {
      $fields = [
          'name_of_card_supply' => 'like',
          'supply_status' => '=',
          'denomination' => 'like',
          'supply_time' => '=',
      ];
      //获取条件
      $where = $this->searchArray($fields);
      $data = $this->supplierRepo->findWhere($where);
      return $data;


    }
    public function index()
    {
       $results =  $this->get_config_blade(config('oc.supplier.supplierlist'));
       $results['data'] = '';
       return $results;
    }
    public function showUserInfo()
    {
        //获取当前用户信息
        $userInformation = getUser();
        return $userInformation;
    }
    //
    public function store($id)
    {

        try{
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->supplierRepo->update(request()->all(),$id) ){

                } else {
                    throw new Exception(trans('code/store.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/store.destroy.success'),
                ]);
            });
        } catch(Exception $e){
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/store.destroy.fail')),
            ]);

        }
        return array_merge($this->results,$exception);
    }
    //卡密供货页面
    public function cardIndex()
    {
        try{

        } catch(Exception $e){
            abort(404);
        }
    }

    //卡密供货
    public function cardPassEncryption()
    {
        try{

        } catch (Exception $e){

        }


    }



}