<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOfertasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ofertas', function(Blueprint $table)
		{
			$table->foreign('vendedores_id')->references('id')->on('vendedores')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('ofertas', function(Blueprint $table)
		{
			$table->dropForeign('ofertas_vendedores_id_foreign');
			$table->dropForeign('ofertas_produtos_id_foreign');
			$table->dropForeign('ofertas_empresas_id_foreign');
		});
	}

}
