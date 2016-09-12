<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersAddColumnMobileToken extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasColumn('users', 'mobile_token'))
		{
			Schema::table('users', function($table)
			{
    			$table->string('mobile_token', 100)->nullable();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasColumn('users', 'mobile_token'))
		{
			Schema::table('users', function($table)
			{
    			$table->dropColumn('mobile_token');
			});
		}
	}

}
