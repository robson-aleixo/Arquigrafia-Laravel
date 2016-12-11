<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoToPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasColumn('photos', 'videoYoutube'))
		{
			Schema::table('photos',function ($table) {
				$table->string('videoYoutube')->nullable();
			});
		}	

		if(!Schema::hasColumn('photos', 'videoVimeo'))
		{
			Schema::table('photos',function ($table) { 			
				$table->string('videoVimeo')->nullable();
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
		Schema::table('photos', function ($table) {
    		$table->dropColumn('videoYoutube');
    		$table->dropColumn('videoVimeo');
		});
	}

}
