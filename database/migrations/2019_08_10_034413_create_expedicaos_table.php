<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpedicaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expedicaos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('fechamento_id')->unsigned()->default(0);
			$table->integer('motoristas_id')->unsigned()->default(0);
			$table->integer('veiculos_id')->unsigned()->default(0);
			$table->integer('produtos_id')->unsigned()->default(0);
			$table->integer('empresas_id')->unsigned()->default(1);
			$table->date('disponibilidade')->nullable();
			$table->date('datasaida')->nullable();
			$table->boolean('emrecepcao')->nullable();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('expedicaos');
	}

}
