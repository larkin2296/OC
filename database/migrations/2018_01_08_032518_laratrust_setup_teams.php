<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LaratrustSetupTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing teams
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::table('role_user', function (Blueprint $table) {
            // Drop role foreign key and primary key
            $table->dropForeign(['role_id']);
            $table->dropPrimary(['user_id', 'role_id', 'user_type']);

            // Add company_id column
            $table->unsignedInteger('company_id')->nullable();

            // Create foreign keys
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')
                ->onUpdate('cascade')->onDelete('cascade');

            // Create a unique key
            $table->unique(['user_id', 'role_id', 'user_type', 'company_id']);
        });

        Schema::table('permission_user', function (Blueprint $table) {
           // Drop permission foreign key and primary key
            $table->dropForeign(['permission_id']);
            $table->dropPrimary(['permission_id', 'user_id', 'user_type']);

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            // Add company_id column
            $table->unsignedInteger('company_id')->nullable();

            $table->foreign('company_id')->references('id')->on('companies')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['user_id', 'permission_id', 'user_type', 'company_id'], 'user_permission_team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
    }
}
