<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFechamentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fechamentos', function(Blueprint $table)
		{
			$table->foreign('demanda_id')->references('id')->on('demandas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('oferta_id')->references('id')->on('ofertas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
		Schema::table('fechamentos', function(Blueprint $table)
		{
			$table->dropForeign('fechamentos_demanda_id_foreign');
			$table->dropForeign('fechamentos_oferta_id_foreign');
			$table->dropForeign('fechamentos_empresas_id_foreign');
		});
	}

}
