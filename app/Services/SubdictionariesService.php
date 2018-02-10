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
Class SubdictionariesService extends BasicService{
    use ServiceTrait, ResultTrait, ExceptionTrait;

    public function __construct(Builder $builder)
    {
        parent::__construct();
        $this->builder = $builder;
    }

    public function index()
    {
        $html = $this->builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'sub_chinese', 'name' => 'sub_chinese', 'title' => 'Sub_chinese'],
            ['data' => 'sub_english', 'name' => 'sub_english', 'title' => 'Sub_english'],
            ['data' => 'dict_id', 'name' => 'dict_id', 'title' => 'Dict_id'],
            ['data' => 'e_name', 'name' => 'e_name', 'title' => 'E_name'],
            ['data' => 'e_formate', 'name' => 'e_formate', 'title' => 'E_formate'],
            ['data' => 'is_desc', 'name' => 'is_desc', 'title' => 'Is_desc'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            ['data' => 'action', 'name' => 'action', 'title' => 'action', 'class' => 'text-center', 'sorting' => false],
        ])
            ->ajax([
                'url' => route('admin.Subdictionaries.index'),
                'type' => 'GET',
            ]);
        return [
            'html' => $html
        ];
    }

    public function datatables()
    {
        $data = $this->subdictionariesRepo->all(['id','is_desc', 'sub_chinese', 'sub_english', 'created_at', 'updated_at']);

        return DataTables::of($data)
            ->editColumn('id', '{{$id_hash}}')
            ->addColumn('action', getThemeTemplate('back.system.subdictionaries.datatable'))
            ->make();
    }

}