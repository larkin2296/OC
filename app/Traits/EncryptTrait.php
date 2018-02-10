<?php 

namespace App\Traits;

use Hashids;

Trait EncryptTrait
{
	private $HashidsConnection = 'main';
	
	/**
	 * 设置 加密 链接
	 * @param		
	 * @author		wen.zhou@bioon.com
	 * @date		2016-05-12 10:47:00
	 * @return		
	 */
	public function setEncryptConnection($connection = 'main'){
		$this->HashidsConnection = $connection;
	}

	public function getEncryptConnection(){
		return $this->HashidsConnection;
	}

	/**
	 * 加密id
	 * @param		
	 * @author		wen.zhou@bioon.com
	 * @date		2016-05-12 10:47:11
	 * @return		
	 */
	public function encodeId($id){
		// id无效直接返回
		if(!$id) return $id;

		if(checkEncrypt($this->getEncryptConnection())){
			return Hashids::connection($this->getEncryptConnection())->encode($id);
		}else{
			return $id;
		}
	}

	/**
	 * 解密id
	 * @param		
	 * @author		wen.zhou@bioon.com
	 * @date		2016-05-12 10:47:16
	 * @return		
	 */
	public function decodeId($id){
		// id无效直接返回
		if(!$id) return $id;
		if(checkEncrypt($this->getEncryptConnection())){
			$ids = Hashids::connection($this->getEncryptConnection())->decode($id);
			if(isset($ids[0])){
				return $ids[0];
			}else{
				if(!request()->ajax()){
					throw new \Exception(trans('code/global.encrypt_fail'));
				}else{
					return response()->json([
						'result' => false,
						'message' => trans('code/global.encrypt_fail')
					]);
				}
			}
		}else{
			return $id;
		}
	}
}