<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFechamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fechamentos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('oferta_id')->unsigned()->default(0);
			$table->integer('demanda_id')->unsigned()->default(0);
			$table->integer('empresas_id')->unsigned()->default(1);
			$table->integer('quantidade')->nullable();
			$table->decimal('valorunitario', 10)->nullable();
			$table->decimal('valorfinal', 10)->nullable();
			$table->date('inicioentrega')->nullable();
			$table->date('fimentrega')->nullable();
			$table->integer('comissionado_id')->default(0);
			$table->decimal('valorcomissionado', 10)->nullable();
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
		Schema::drop('fechamentos');
	}

}
