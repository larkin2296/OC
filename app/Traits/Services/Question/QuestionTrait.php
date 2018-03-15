<?php

namespace App\Traits\Services\Question;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use App\Repositories\Models\Question;
Trait QuestionTrait
{

    /**
     * 质疑条件选择
     * @return [type] [description]
     */
    public function searchWhere($data)
    {
         $query = new Question();
         $results = $query->where(function($query)use($data){
         $data['question_num'] && $query->where('question_num', 'like', '%' . $data['question_num'] . '%');
         $data['report_num'] && $query->where('report_num', 'like', '%' . $data['report_num'].'%');
         $data['status'] && $query->where('status',$data['status']);
         $data['operation_name'] && $query->where('operation_name','like','%'.$data['operation_name'].'%');
        })->get();
        return $results;
    }
    /**发送质疑**/
    public function send($question_id,$end_date,$content,$id,$status)
    {
        /*开启事物*/
        DB::beginTransaction();
        try{
            /*同步主表数据*/
            $data = $this->questionRepo->update(['end_date'=>$end_date,'content'=>$content,'status'=>2],$question_id);
                /*成功 增加发送次数*/
                $structure = DB::table('question')->where('id',$question_id)->increment('sending');
                /*更新次数*/
                $str = $this->questionRepo->find($question_id);$sending = $str->sending;
                $info = $this->questioningRepo->update(['sending'=>$sending],$id);
                /*区分邮件发送请求*/
                if($status !=1 ){
                    if($structure&&$info&&$data){
                        DB::commit();
                        return $info;
                    }else{
                        return false;
                    }
                }else{
                    #TODO 验证公司id(companies) 2.查询公司下所注册的邮箱(mail) 3.将当前需要发送的数据取出（send_information）
                   /*内容 标题 发件人名称 账号*/
                   /*虚拟数据*/
//                   $company_id = 1;
//                    $info = $this->checkMail($company_id,$id);
                    if($structure&&$info&&$data){
                        DB::commit();
                        return $info;
                    }else{
                        return false;
                    }
                }
        } catch(Exception $e){
            DB::rollBack();
        }
        /*业务*/
    }
    protected function checkMail($company_id,$id)
    {
        $company_info = $this->mailRepo->findWhereIn('company_id',[$company_id])->all();
        #TODO 将数据发送到服务器邮箱 ：
        $results = $this->questioningRepo->find($id);
        $email = $results->email;
        $account = explode(';',$email);//得到要发送邮件的数组
        $email_theme = $results->email_theme;//邮件主题
        $company_name = $company_info->mail_account;//己方公司的账户
        #todo 发送邮件接口

    }
}