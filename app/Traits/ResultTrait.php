<?php 

namespace App\Traits;

trait ResultTrait
{
	protected $results = [
		'code' => '200',
		'result' => false,
		'data' => [],
		'message' => '',
	];
}