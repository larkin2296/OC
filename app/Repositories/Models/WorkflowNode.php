<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

class WorkflowNode extends Model implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $fillable = [
        'company_id', 'workflow_id', 'name', 'en_name', 'is_message_notice', 'is_email_notice', 'organize_role_id', 'role_id', 'rule', 'description', 'sort'
    ];

    protected $appends = [
        'id_hash', 'role_id_hash',
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('workflownode', $this->id);
    }

    public function getRoleIdHashAttribute()
    {
        return $this->encodeId('role', $this->role_id);
    }
   
    public function role()
    {
        return $this->hasOne(\App\Role::class, 'id', 'role_id');
    }
}
