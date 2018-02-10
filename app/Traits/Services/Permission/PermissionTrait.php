<?php 

namespace App\Traits\Services\Permission;

Trait PermissionTrait
{

	/**
	 * 权限选择
	 * @return [type] [description]
	 */
	public function permissionSelect($permissionSelected = [])
	{
		$results = [];
		/*所有的权限*/
		$permissions = $this->permissionRepo->all();
		if($permissions->isNotEmpty()) {
			foreach($permissions as $key => $permission) {
				$name = $permission->name;
				$nameArr = explode('-', $name);
				/*获取模块名称*/
				$lastNameArrValue = $nameArr[count($nameArr) - 1];

				if(in_array($permission->name, $permissionSelected)) {
					$results[$lastNameArrValue][$permission->id] = [
						'dispaly_name' => $permission->display_name,
						'selected' => true,
					];
				} else {
					$results[$lastNameArrValue][$permission->id] = [
						'dispaly_name' => $permission->display_name,
						'selected' => false,
					];
				}
			}
		}

		return $results;
	}
}