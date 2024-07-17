<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVeiculosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('veiculos', function(Blueprint $table)
		{
			$table->foreign('frete_id')->references('id')->on('fretes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('transportadoras_id')->references('id')->on('transportadoras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('empresas_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('veiculos', function(Blueprint $table)
		{
			$table->dropForeign('veiculos_frete_id_foreign');
			$table->dropForeign('veiculos_empresas_id_foreign');
			$table->dropForeign('veiculos_transportadoras_id_foreign');
		});
	}

}
