<?php 

namespace App\Traits;

use Hashids;

Trait RepositoryTrait
{
	/**
	 * 按照条件修改数据
	 * @param  [type] $data  [description]
	 * @param  array  $where [description]
	 * @return [type]        [description]
	 */
    public function updateWhere($data, array $where)
    {
        $this->applyScope();
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $this->applyConditions($where);

        $updated = $this->model->update($data);

        event(new \Prettus\Repository\Events\RepositoryEntityUpdated($this, $this->model->getModel()));

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        return $updated;
    }


    /**
     * Delete multiple entities by given criteria.
     *
     * @param array $where
     *
     * @return int
     */
    public function forceDeleteWhere(array $where)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $this->applyConditions($where);

        $deleted = $this->model->forceDelete();

        event(new \Prettus\Repository\Events\RepositoryEntityDeleted($this, $this->model->getModel()));

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        return $deleted;
    }
}