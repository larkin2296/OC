<?php 

$router->group(['namespace' => 'Back'], function($router) {

	$router->group(['prefix' => "attachment", 'as' => 'attachment.'], function($router) {

		/*附件上传*/
		$router->post('upload', [
			'as' => 'upload',
			'uses' => 'AttachmentController@upload',
		]);

		/*查看附件*/
		$router->get('show/{id}', [
			'as' => 'show',
			'uses' => 'AttachmentController@show',
		]);
	});
});