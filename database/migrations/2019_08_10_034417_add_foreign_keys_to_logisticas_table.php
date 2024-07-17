<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLogisticasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logisticas', function(Blueprint $table)
		{
			$table->foreign('fechamento_id')->references('id')->on('fechamentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('expedicao_id')->references('id')->on('expedicaos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('logisticas', function(Blueprint $table)
		{
			$table->dropForeign('logisticas_fechamento_id_foreign');
			$table->dropForeign('logisticas_motoristas_id_foreign');
			$table->dropForeign('logisticas_veiculos_id_foreign');
			$table->dropForeign('logisticas_produtos_id_foreign');
			$table->dropForeign('logisticas_empresas_id_foreign');
		});
	}

}
