<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

class Menu extends Model implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $fillable = [
    	'name', 'route', 'icon', 'permission', 'description', 'sort', 'route_prefix', 'position'
    ];

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('menu', $this->id);
    }

    public function parentMenu()
    {
    	return $this->morphToMany(Menu::class, 'recursive', 'recursive_relations', 'current_id', 'recursive_id');
    }

    public function sonMenus()
    {
    	return $this->morphToMany(Menu::class, 'recursive', 'recursive_relations', 'recursive_id', 'current_id')
                    ->orderBy('sort', 'asc');
    }

    /**
     * Mutator
     */
    public function getUrlRouteAttribute()
    {
        $urlRoute = url('/');
        try {
            $urlRoute = route($this->route);
        } catch (\Exception $e) {
            
        }
        return $urlRoute;
    }
}
