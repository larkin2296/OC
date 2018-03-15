<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

/**
 * Class ReportTask.
 *
 * @package namespace App\Repositories\Models;
 */
class ReportTask extends Model implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $dates = [
        'task_countdown', 'report_countdown', 'assigned_at', 'report_first_received_date'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var arrayreport_complete_countdown
     */
    protected $fillable = [
    	'report_id','report_identify','report_first_received_date', 'assigned_at', 'drug_name', 'first_drug_name', 'event_term', 'first_event_term','seriousness','standard_of_seriousness','case_causality','report_cate','task_user_id','task_user_name','organize_role_id','organize_role_name','received_from_id','status','source_id','task_countdown', 'report_countdown', 'regulation_id', 'data_insert_countdown', 'data_qc_countdown', 'medical_exam_countdown', 'medical_exam_qc_countdown', 'report_submit_countdown', 'report_complete_countdown', 'countdown_unit'
    ];

    protected $appends = [
        'id_hash', 'report_id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('reporttask', $this->id);
    }

    public function getReportIdHashAttribute()
    {
        return $this->encodeId('reportmainpage', $this->report_id);
    }

}
