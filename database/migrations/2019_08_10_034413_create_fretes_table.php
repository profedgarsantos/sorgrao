<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFretesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fretes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('distanciainicial')->nullable();
			$table->integer('distanciafinal')->nullable();
			$table->decimal('valorfrete', 10)->nullable();
			$table->integer('tiposfretes_id')->unsigned()->default(0);

			$table->foreign('tiposfretes_id')->references('id')->on('tiposfretes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fretes');
	}

}
