<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVendedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vendedores', function(Blueprint $table)
		{
			$table->foreign('funrural_id')->references('id')->on('funrurals')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('vendedores', function(Blueprint $table)
		{
			$table->dropForeign('vendedores_funrural_id_foreign');
			$table->dropForeign('vendedores_usuario_id_foreign');
			$table->dropForeign('vendedores_empresas_id_foreign');
		});
	}

}
