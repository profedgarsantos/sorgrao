<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMotoristasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('motoristas', function(Blueprint $table)
		{
			$table->foreign('transportadora_id')->references('id')->on('transportadoras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('motoristas', function(Blueprint $table)
		{
			$table->dropForeign('motoristas_transportadora_id_foreign');
			$table->dropForeign('motoristas_usuario_id_foreign');
			$table->dropForeign('motoristas_empresas_id_foreign');
		});
	}

}
