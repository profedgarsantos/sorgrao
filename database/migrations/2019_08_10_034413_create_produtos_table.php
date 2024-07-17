<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 10)->nullable()->comment('kg ou saco');
			$table->string('tipounidade');
			$table->integer('empresas_id')->unsigned()->default(1);
			$table->integer('tiposfretes_id')->unsigned()->default(1);

			});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produtos');
	}

}
