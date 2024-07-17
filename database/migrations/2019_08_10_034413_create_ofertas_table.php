<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfertasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ofertas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('quantidade')->nullable();
			$table->decimal('valorunitario', 10,2)->nullable();
			$table->decimal('valorunitariorevenda', 10,2)->nullable();
			$table->date('validade')->nullable();
			$table->integer('distanciavendedor')->nullable();
			$table->boolean('cancelado')->default(0);
			$table->string('tipoentrega', 45)->nullable()->comment('(cif ou FOB - calcula frete para o comprador)');
			$table->integer('capacidadeexpedicao')->nullable();
			$table->integer('vendedores_id')->unsigned()->default(0);
			$table->integer('empresas_id')->unsigned()->default(1);
			$table->integer('produtos_id')->unsigned()->default(0);
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
		Schema::drop('ofertas');
	}

}
