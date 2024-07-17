<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendedores', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nomebanco', 50)->nullable();
			$table->integer('numerobanco')->nullable();
			$table->string('agencia', 10)->nullable();
			$table->string('contacorrente', 10)->nullable();
			$table->integer('usuario_id')->unsigned()->default(0);
			$table->integer('funrural_id')->unsigned()->default(0);
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
		Schema::drop('vendedores');
	}

}
