<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAttachmentsTable.
 */
class CreateAttachmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable()->default('')->comment('加密文件名');
            $table->string('origin_name')->nullable()->default('')->comment('原始文件名');
            $table->integer('file_size')->nullable()->default(0)->comment('文件大小');
            $table->string('path')->nullable()->default('')->comment('文件相对路径');
            $table->string('file_ext', 10)->nullable()->default('')->comment('文件扩展名');
            $table->string('ext_info')->nullable()->default('')->comment('文件扩展信息');
            $table->integer('user_id')->nullable()->default(0)->comment('用户创建者id');
            $table->string('user_name')->nullable()->default(0)->comment('用户创建者id');

            /*软删除*/
            $table->softDeletes();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachments');
	}
}
