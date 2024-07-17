<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVeiculosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('veiculos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('modelo', 45)->nullable();
			$table->string('placa', 45)->nullable();
			$table->string('capacidade', 45)->nullable();
			$table->boolean('ativo')->nullable();
			$table->integer('transportadoras_id')->unsigned()->default(0);
			$table->integer('frete_id')->unsigned()->default(0);
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
		Schema::drop('veiculos');
	}

}
