<?php 

namespace App\Traits\Services\Workflow;

use App\Repositories\Interfaces\WorkflowRepository;

Trait WorkflowTrait
{
	/**
	 * 获取下一个工作流节点的用户
	 * @return [type] [description]
	 */
	public function nextNodeUsers($organizeRoleId = '', $companyId = '')
	{
		$companyId = getCompanyId($companyId);

		/*获取工作流*/
		$workflow = $this->getWorkflow($companyId);
		
		/*所有的工作流节点*/
		$workflowNodes = $workflow->nodes->keyBy('organize_role_id');
		/*当前工作流节点*/
		$curWorkflowNode = $workflowNodes[$organizeRoleId];
		/*获取当前工作流节点的下一个节点*/
		$nextWorkflowNode = $workflow->nodes->where('sort', '>', $curWorkflowNode->sort)->first();

		/*返回节点的用户*/
		return $this->nodeUsers($nextWorkflowNode, $companyId);
	}

	/**
	 * 获取当前节点的用户
	 * @return [type] [description]
	 */
	public function curNodeUsers($organizeRoleId = '', $companyId = '')
	{
		$companyId = getCompanyId($companyId);

		/*获取工作流*/
		$workflow = $this->getWorkflow($companyId);

		/*所有的工作流节点*/
		$workflowNodes = $workflow->nodes->keyBy('organize_role_id');
		/*当前工作流节点*/
		$curWorkflowNode = $workflowNodes[$organizeRoleId];

		/*返回节点的用户*/
		return $this->nodeUsers($curWorkflowNode, $companyId);
	}

	private function nodeUsers($workflowNode, $companyId)
	{
		// 返回节点的用户
		return $workflowNode->role->users($companyId)->get();
	}

	private function getWorkflow($companyId)
	{
		/*获取工作流*/
		$workflowWhere = [
			'company_id' => $companyId,
			'status' => getCommonCheckValue(true),
			'is_use' => getCommonCheckValue(true),
		];
		
		return $this->workflowRepo->with('nodes')->findWhere($workflowWhere)->first();
	}
}