<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursiveRelationsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recursive_relations', function(Blueprint $table) {
            $table->integer('current_id');
            $table->integer('recursive_id');
            $table->string('recursive_type');
            $table->integer('sort')->nullable()->default(1)->comment('排序');
            $table->primary(['current_id', 'recursive_id', 'recursive_type'], 'recursiveprimary');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recursive_relations');
	}

}
