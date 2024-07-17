<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFunruralsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('funrurals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('valor', 10)->nullable();
			$table->string('descricao')->nullable();
			$table->integer('empresas_id')->unsigned()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('funrurals');
	}

}
