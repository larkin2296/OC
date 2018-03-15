<?php
namespace App\Traits;
use Hashids;
use DB;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Repositories\Models\Dictionaries;
use Mockery\Exception;

Trait DictionariesTrait{
//    use ServiceTrait, ResultTrait, ExceptionTrait;
    /**
     * 字典查询
     * @param  [type] $array    [description]
     * @param  [type]           [description]
     * @return [type]           [description]
     */
     public function hasManyDictionaries($results)
     {
       if (is_array($results)) {
          $dictionaries = new Dictionaries();
          $comments = $dictionaries::whereIn('chinese', $results)->select('id')->get();
          $data = $comments->each(function ($item,$key) {
          $item->comments = $item->comments;
          })->toArray();
           return $data;
       }else
           {
                  return false;
           }

     }


}