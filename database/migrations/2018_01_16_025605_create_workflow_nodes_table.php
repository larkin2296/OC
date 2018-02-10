<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowNodesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflow_nodes', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('company_id')->nullable()->default(0)->comment('单位id');
            $table->integer('workflow_id')->nullable()->default(0)->comment('工作流id');
            $table->string('name')->nullable()->default('')->comment('工作流节点名称');
            $table->string('en_name')->nullable()->default('')->comment('工作流节点英文名称');
            $table->tinyInteger('is_message_notice')->nullable()->default(1)->comment('1-短信通知, 2-短信不通知');
            $table->tinyInteger('is_email_notice')->nullable()->default(1)->comment('1-邮件通知, 2-邮件不通知');
            $table->tinyInteger('organize_role_id')->nullable()->default(0)->comment('组织结构角色id');
            $table->integer('role_id')->nullable()->default(0)->comment('角色id');
            $table->text('rule')->nullable()->comment('规则');
            $table->text('description')->nullable()->comment('描述');
            $table->tinyInteger('sort')->nullable()->default(1)->comment('排序');

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
		Schema::drop('workflow_nodes');
	}

}
