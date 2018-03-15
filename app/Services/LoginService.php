<?php
namespace App\Services;
use App\Services\Service as BasicService;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

class LoginService extends BasicService
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }
    public function datatables()
    {
     //页面信息
        dd(123);
    }
    public function index()
    {
     //页面信息
    }
    /*注册*/
    public function create()
    {
        try{
            $exception = DB::transaction(function() {
                if( $info = $this->ocloginRepo->create(request()->all())){
                } else {
                    throw new Exception(trans('code/login.create.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/login.create.success'),
                ]);
            });
        } catch(Exception $e){
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/login.create.fail')),
            ]);
        }
    }
    /*登录*/
}