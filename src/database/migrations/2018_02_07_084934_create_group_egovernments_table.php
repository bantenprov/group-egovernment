<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupEgovernmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('group_egovernments', function(Blueprint $table) {
			$table->increments('id');
			$table->string('label');
			$table->string('description');
			$table->integer('user_id');
			$table->timestamps();
			$table->softDeletes();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::drop('group_egovernments');
	}
}
