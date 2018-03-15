<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

class Workflow extends Model implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $fillable = ['name', 'company_id', 'company_name', 'status', 'is_use'];

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('workflow', $this->id);
    }

    /**
     * 获取工作流节点
     * @return [type] [description]
     */
    public function nodes()
    {
        return $this->hasMany(WorkflowNode::class, 'workflow_id', 'id')
                    ->orderBy('sort', 'asc');
    }
}
