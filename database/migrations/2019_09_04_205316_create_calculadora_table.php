<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculadoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculadora', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comissionados_id');
            $table->decimal('valorfrete', 10,2);
            $table->decimal('valorcomissionado', 10,2);
            $table->decimal('valoroferta', 10,2);
            $table->decimal('valorfunrural', 10,2);
            $table->decimal('valorfinal', 10,2);           
			$table->integer('ofertas_id')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('ofertas_id')->references('id')->on('ofertas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculadora');
    }
}
