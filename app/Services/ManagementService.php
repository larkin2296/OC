<?php
namespace App\Services;
use App\Repositories\Models\Source;
use App\Services\Service as BasicService;
use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;
use TCPDF;
use Excel;

Class ManagementService extends Service
{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function datatables()
    {
        $searchFields = [
            'oc_number' => 'like',
            'order_type' => '=',
            'province' => '=',
            'name' => 'like',
            'status' => '=',
            'card_number' => 'like',
            'number' => 'like',
        ];
        /*获取查询条件*/
        $where = $this->searchArray($searchFields);
        /*获取数据*/
        $data = $this->managementRepo->findWhere($where);
        return DataTables::of($data)
            ->addColumn('action', getThemeTemplate('ocback.managements.datatable'))
            ->addColumn('status', getThemeTemplate('back.homepage.questioning.status'))
            ->make();
    }

    public function index()
    {
        $html = $this->builder->columns([

            ['data' => 'number', 'name' => 'number', 'title' => '订单号', 'class' => 'text-center'],
            ['data' => 'oc_number', 'name' => 'oc_number', 'title' => '油卡编号', 'class' => 'text-center'],
            ['data' => 'oc_name', 'name' => 'oc_name', 'title' => '油卡信息', 'class' => 'text-center'],
            ['data' => 'number_uptime', 'name' => 'number_uptime', 'title' => '订单修改时间', 'class' => 'text-center'],
            ['data' => 'card_number', 'name' => 'card_number', 'title' => '油卡号', 'class' => 'text-center'],
            ['data' => 'name', 'name' => 'name', 'title' => '用户名', 'class' => 'text-center'],
            ['data' => 'number_status', 'name' => 'number_status', 'title' => '订单状态', 'class' => 'text-center'],
            ['data' => 'img_id', 'name' => 'img_id', 'title' => '图片id', 'class' => 'text-center'],

        ])
            ->ajax([
                'url' => route('admin.management.index'),
                'type' => 'GET',
            ])->parameters(config('back.datatables-cfg.basic'));
        return [
            'html' => $html
        ];
    }

    /*添加*/
    public function create()
    {
        try {
            $exception = DB::transaction(function () {
                //订单编号
                //
                if ($info = $this->managementRepo->create(request()->all())) {
                } else {
                    throw new Exception(trans('code/management.create.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/management.create.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/management.create.fail')),
            ]);
        }
        return array_merge($this->results, $exception);
    }
    /*油卡删除*/
    public function destroy($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->managementRepo->delete($id) ){
                    /*删除油卡关联事件*/
                } else {
                    throw new Exception(trans('code/management.destroy.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/management.destroy.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/management.destroy.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
    /*油卡状态更改*/
    public function update($id)
    {
        try {
            $exception = DB::transaction(function() use ($id) {

                if( $info = $this->managementRepo->find($id)) {
                    if($info->status == 1)
                    {
                        $info = $this->managementRepo->update(['status'=>0],$id);
                    } else{
                        $info = $this->managementRepo->update(['status'=>1],$id);

                    }
                } else {
                    throw new Exception(trans('code/management.update.fail'), 2);
                }

                return array_merge($this->results, [
                    'result' => true,
                    'message' => trans('code/management.update.success'),
                ]);
            });
        } catch (Exception $e) {
            $exception = array_merge($this->results, [
                'result' => false,
                'message' => $this->handler($e, trans('code/management.update.fail')),
            ]);
        }

        return array_merge($this->results, $exception);
    }
    public function show()
    {
        dd(123);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // 设置文档信息
        $pdf->SetCreator('Hello world');
        $pdf->SetAuthor('dyk');
        $pdf->SetTitle('TCPDF示例');
        $pdf->SetSubject('TCPDF示例');
        $pdf->SetKeywords('TCPDF, PDF, PHP');

        // 设置页眉和页脚信息
        $pdf->SetHeaderData('tcpdf_logo.jpg', 30, 'www.marchsoft.cn', '三月软件！', [0, 64, 255], [0, 64, 128]);
        $pdf->setFooterData([0, 64, 0], [0, 64, 128]);

        // 设置页眉和页脚字体
        $pdf->setHeaderFont(['stsongstdlight', '', '10']);
        $pdf->setFooterFont(['helvetica', '', '8']);

        // 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        $pdf->SetMargins(15, 15, 15);//页面间隔
        $pdf->SetHeaderMargin(5);//页眉top间隔
        $pdf->SetFooterMargin(10);//页脚bottom间隔

        // 设置分页
        $pdf->SetAutoPageBreak(true, 25);

        // 设置自动换页
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // 设置图像比例因子
        $pdf->setImageScale(1.25);

        // 设置默认字体构造子集模式
        $pdf->setFontSubsetting(true);

        // 设置字体 stsongstdlight支持中文
        $pdf->SetFont('stsongstdlight', '', 14);

        // 添加一页
        $pdf->AddPage();

        $pdf->Ln(5);//换行符

        $html = '
            <table width="400" border="1">
                <tr>
                    <th align="left">消费项目</th>
                    <th align="right">一月</th>
                    <th align="right">二月</th>
                </tr>
                <tr>
                    <td align="left">衣服</td>
                    <td align="right">$241.10</td>
                    <td align="right">$50.20</td>
                </tr>
                <tr>
                    <td align="left">化妆品</td>
                    <td align="right">$30.00</td>
                    <td align="right">$44.45</td>
                </tr>
                <tr>
                    <td align="left">食物</td>
                    <td align="right">$730.40</td>
                    <td align="right">$650.00</td>
                </tr>
                <tr>
                    <th align="left">总计</th>
                    <th align="right">$1001.50</th>
                    <th align="right">$744.65</th>
                </tr>
            </table>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');

        //输出PDF
        $pdf->Output('t.pdf', 'I');//I输出、D下载
    }
    public function excel()
    {
        dd(123);
    }
}