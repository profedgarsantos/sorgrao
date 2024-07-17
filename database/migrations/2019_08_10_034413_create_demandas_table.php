<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDemandasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('demandas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('quantidade')->nullable();
			$table->decimal('valorunitario', 10,2)->nullable();
			$table->date('validade')->nullable();
			$table->boolean('finalizado')->nullable();
			$table->integer('capacidaderecepcao')->nullable();
			$table->boolean('cancelado')->default(0);
			$table->integer('produtos_id')->unsigned()->default(0);
			$table->integer('compradores_id')->unsigned()->default(0);
			$table->integer('empresas_id')->unsigned()->default(1);
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
		Schema::drop('demandas');
	}

}
