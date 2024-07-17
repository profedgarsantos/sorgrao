<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTransportadorasFechamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('transportadoras_fechamento', function(Blueprint $table)
		{
			$table->foreign('fechamento_id')->references('id')->on('fechamentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('transportadoras_id')->references('id')->on('transportadoras')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('transportadoras_fechamento', function(Blueprint $table)
		{
			$table->dropForeign('transportadoras_fechamento_fechamento_id_foreign');
			$table->dropForeign('transportadoras_fechamento_transportadoras_id_foreign');
			
		});
	}

}
