<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogisticasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logisticas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('expedicao_id')->unsigned()->default(0);
			$table->integer('fechamento_id')->unsigned()->default(0);
			$table->integer('produtos_id')->unsigned()->default(0);
			$table->integer('empresas_id')->unsigned()->default(1);
			$table->dateTime('datarecepcao')->nullable();
			$table->integer('pesoliquido')->nullable();
			$table->integer('quantidade')->nullable();
			$table->string('notafiscal', 45)->nullable();
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
		Schema::drop('logisticas');
	}

}
