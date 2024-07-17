<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExpedicaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('expedicaos', function(Blueprint $table)
		{
			$table->foreign('fechamento_id')->references('id')->on('fechamentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('produtos_id')->references('id')->on('produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('empresas_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('veiculos_id')->references('id')->on('veiculos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('motoristas_id')->references('id')->on('motoristas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('expedicaos', function(Blueprint $table)
		{
			$table->dropForeign('expedicaos_fechamento_id_foreign');
			$table->dropForeign('expedicaos_veiculos_id_foreign');
			$table->dropForeign('expedicaos_motoristas_id_foreign');
			$table->dropForeign('expedicaos_produtos_id_foreign');
			$table->dropForeign('expedicaos_empresas_id_foreign');
		});
	}

}
