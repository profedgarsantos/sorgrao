<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password');
			$table->string('cep', 45)->nullable();
			$table->string('logradouro')->nullable();
			$table->string('bairro')->nullable();
			$table->string('numero', 45)->nullable();
			$table->string('telefone', 45)->nullable();
			$table->string('celular', 45)->nullable();
			$table->string('cnpjcpf', 45)->nullable();
			$table->string('inscricaoestadual', 45)->nullable();
			$table->string('inscricaomunicipal', 45)->nullable();
			$table->boolean('ativo')->default(1);
			$table->integer('cidades_id')->unsigned()->default(0);
			$table->integer('grupos_id')->unsigned()->default(0);
			$table->integer('empresas_id')->unsigned()->default(1);
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
