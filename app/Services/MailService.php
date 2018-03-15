<?php
namespace App\Services;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

class MailService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    /*添加*/
   public function create()
   {
       try {
           $exception = DB::transaction(function() {
               if( $info = $this->mailRepo->create(request()->all())){
               } else {
                   throw new Exception(trans('code/mail.create.fail'), 2);
               }

               return array_merge($this->results, [
                   'result' => true,
                   'message' => trans('code/mail.create.success'),
               ]);
           });
       } catch (Exception $e) {
           $exception = array_merge($this->results, [
               'result' => false,
               'message' => $this->handler($e, trans('code/mail.create.fail')),
           ]);
       }

       return array_merge($this->results, $exception);
   }
}