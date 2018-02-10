<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ModelTrait;

class ReportValues extends Model implements Transformable
{
    use TransformableTrait;
	use SoftDeletes;
	use ModelTrait;

    protected $fillable = [
    	'report_id', 'report_tab_id', 'col', 'col_name', 'name', 'description', 'value', 'is_table', 'table_alias', 'table_row_id', 'company_id',
    ];

    protected $appends = [
    	'report_id_hash'
    ];

    public function getReportIdHashAttribute()
    {
        return $this->encodeId('reportmainpage', $this->report_id);
    }
}
