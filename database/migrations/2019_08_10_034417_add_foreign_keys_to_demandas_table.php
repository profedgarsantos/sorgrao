<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDemandasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('demandas', function(Blueprint $table)
		{
			$table->foreign('compradores_id')->references('id')->on('compradores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('produtos_id')->references('id')->on('produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('demandas', function(Blueprint $table)
		{
			$table->dropForeign('demandas_comprador_id_foreign');
			$table->dropForeign('demandas_produto_id_foreign');
			$table->dropForeign('demandas_empresas_id_foreign');
		});
	}

}
