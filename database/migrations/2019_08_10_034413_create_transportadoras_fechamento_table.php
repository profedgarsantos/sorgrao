<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransportadorasFechamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transportadoras_fechamento', function(Blueprint $table)
		{
			$table->integer('transportadoras_id')->unsigned()->default(0);
			$table->integer('fechamento_id')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transportadoras_fechamento');
	}

}
