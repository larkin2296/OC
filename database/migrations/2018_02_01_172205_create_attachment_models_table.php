<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAttachmentModelsTable.
 */
class CreateAttachmentModelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachment_models', function(Blueprint $table) {
            $table->unsignedInteger('attachment_id');
			$table->unsignedInteger('attachment_model_id');
            $table->string('attachment_model_type');

            $table->foreign('attachment_id')->references('id')->on('attachments')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['attachment_model_id', 'attachment_id', 'attachment_model_type'], 'attach_model_primary');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attachment_models');
	}
}
