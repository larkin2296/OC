<?php

namespace App\Repositories\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ReportMainpage extends Model implements Transformable
{
    use TransformableTrait,ModelTrait;

    protected $table = 'report_mainpage';

    protected $fillable = ['report_first_received_date','report_drug_safety_date','aecountry_id','ae_country','received_fromid_id','received_from_id','research_id','scheme_num','center_number','delayed_reason','brand_name','first_brand_name','drug_name','first_drug_name','first_generic_name',
        'first_event_term','generic_name','event_term','event_of_onset','report_identifier','report_identifier_status','report_type','reporter_name','reporter_organisation','reporter_department','reporter_country','reporter_country_id','reporter_stateor_province','reporter_city','reporter_post','reporter_telephone_number','patient_name',
        'subject_number','date_of_birth','age','company_id','age_at_time_of_onset_unit','sex','patient_contact_information','literature_published_year','literature_author','literature_published_journals','literature_title','regulation_id','severity','is_first_report','first_report_id','is_last_report'];


    /**
     * 获取附件
     * @return [type] [description]
     */
    public function attachments()
    {
    	return $this->morphToMany(Attachment::class, 'attachment_model');
    }
    
    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('reportmainpage', $this->id);
    }
}
