<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMotoristasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('motoristas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transportadora_id')->unsigned()->default(0);
			$table->integer('usuario_id')->unsigned()->default(0);
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
		Schema::drop('motoristas');
	}

}
