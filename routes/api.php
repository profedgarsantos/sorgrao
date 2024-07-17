<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    Route::post('registeruser', 'AuthController@register');
    Route::post('loginuser', 'AuthController@login');
    Route::get('estados/{paises}', 'EstadosController@index');
    Route::get('cidades/{estados}', 'CidadesController@index'); 

    Route::get('estado/{estados}', 'EstadosController@show');
    Route::get('cidade/{cidades}', 'CidadesController@show');

    Route::put('usuario/{empresas}/{usuario}', 'UserController@update');

     //produtos
      Route::get('produtos/{empresas}', 'ProdutosController@index');
     Route::get('produtos/{empresas}/{produtos}', 'ProdutosController@show');

     //transportadoras
      Route::get('transportadoras/{empresas}', 'TransportadorasController@index');
     Route::get('transportadoras/{empresas}/{transportadoras}', 'TransportadorasController@show');


     
       //Veiculos
      Route::get('veiculos/{empresas}', 'VeiculosController@index');
     Route::get('veiculos/{empresas}/{veiculos}', 'VeiculosController@show');

       //funrural
      Route::get('funrural', 'FunruralsController@index');
      Route::get('funrural/{funrural}', 'FunruralsController@show');

       //tiposfretes
      Route::get('tiposfretes', 'TiposFretesController@index');

      //fretes
      Route::post('buscafretes', 'FretesController@busca');

      //motoristas
      Route::post('buscaporusuario', 'MotoristasController@buscaporusuario');
      Route::get('motoristas/{empresas}', 'MotoristasController@index');
      Route::get('motoristas/{empresas}/{motoristas}', 'MotoristasController@show');
   
     

       //ofertas
 Route::get('ofertas/{empresas}', 'OfertasController@index');
 Route::get('ofertas/{empresas}/{ofertas}', 'OfertasController@show');
 Route::post('buscaofertas/{empresas}', 'OfertasController@busca');

 //demandas
 Route::get('demandas/{empresas}', 'DemandasController@index');
 Route::get('demandas/{empresas}/{demandas}', 'DemandasController@show');
 
    

});

Route::group(['middleware' =>['role:superadmin'],'namespace' => 'Api'], function () {
   
    //usuarios
    Route::get('usuarios/{empresas}', 'UserController@index');  //lista de usuarios
    Route::post('buscausuarios/{empresas}', 'UserController@busca');  //buscar usuarios

//config
    Route::get('config/{empresas}', 'ConfigController@index');
    Route::put('config/{empresas}', 'ConfigController@update');
  
      //calculadora
      Route::get('calculadora/{ofertas}', 'CalculadoraController@show');
      Route::put('calculadora/{calculadora}', 'CalculadoraController@update');
      Route::post('calculadora', 'CalculadoraController@store');

      //comissionados
      Route::get('comissionados/{empresas}', 'ComissionadosController@index');
      Route::get('comissionados/{empresas}/{comissionados}', 'ComissionadosController@show');
      Route::put('comissionados/{comissionados}', 'ComissionadosController@update');
      Route::post('comissionados', 'ComissionadosController@store');
      Route::delete('comissionados/{comissionados}', 'ComissionadosController@destroy');

     //produtos
      Route::put('produtos/{empresas}/{produtos}', 'ProdutosController@update');
     Route::post('produtos', 'ProdutosController@store');
     Route::delete('produtos/{produtos}', 'ProdutosController@destroy');

     Route::post('funrural', 'FunruralsController@store');
     Route::put('funrural/{funrural}', 'FunruralsController@update');
    

           //fechamentos
      Route::get('fechamentos/{empresas}', 'FechamentosController@index');
      Route::post('buscaporofertademanda/{empresas}', 'FechamentosController@buscaporofertademanda');
      Route::get('fechamentos/{empresas}/{fechamentos}', 'FechamentosController@show');
      Route::put('fechamentos/{empresas}/{fechamentos}', 'FechamentosController@update');
     Route::post('fechamentos', 'FechamentosController@store');
});



Route::group(['middleware' => ['role:superadmin|comissionados'],'auth:api','namespace' => 'Api'], function () {

     //transportadoras
     Route::put('transportadoras/{empresas}/{transportadoras}', 'TransportadorasController@update');
     Route::post('transportadoras', 'TransportadorasController@store');
     Route::delete('transportadoras/{transportadoras}', 'TransportadorasController@destroy');

       //veiculos
     Route::put('veiculos/{empresas}/{veiculos}', 'VeiculosController@update');
     Route::post('veiculos', 'VeiculosController@store');
     Route::delete('veiculos/{veiculos}', 'VeiculosController@destroy');

      //logistica
      Route::get('logisticas/{empresas}', 'LogisticasController@index');
      Route::get('logisticas/{empresas}/{logisticas}', 'LogisticasController@show');
      Route::put('logisticas/{empresas}/{logisticas}', 'LogisticasController@update');
      Route::post('logisticas', 'LogisticasController@store');
      Route::delete('logisticas/{logisticas}', 'LogisticasController@destroy');
      Route::post('buscalogisticasporfechamento/{empresas}', 'LogisticasController@buscalogisticasporfechamento');
      Route::post('buscalogisticaporexpedicao/{empresas}', 'LogisticasController@buscalogisticaporexpedicao');

       //expedicao
      Route::get('expedicoes/{empresas}', 'ExpedicaosController@index');
      Route::get('expedicoes/{empresas}/{expedicaos}', 'ExpedicaosController@show');
      Route::put('expedicoes/{empresas}/{expedicaos}', 'ExpedicaosController@update');
      Route::post('expedicoes', 'ExpedicaosController@store');
      Route::delete('expedicoes/{expedicaos}', 'ExpedicaosController@destroy');
      Route::post('buscaexpedicaoporfechamento/{empresas}', 'ExpedicaosController@buscaexpedicaoporfechamento');
      Route::post('buscaexpedicaoporlogistica/{empresas}', 'ExpedicaosController@buscaexpedicaoporlogistica');


      Route::get('gerarpedido/{empresas}/{fechamentos}', 'FechamentosController@gerarpedido');
});


Route::group(['middleware' => ['role:superadmin|compradores|comissionados'],'auth:api','namespace' => 'Api'], function () {

           //compradores
        Route::get('compradores/{empresas}', 'CompradoresController@index');
        Route::get('comprador/{empresas}/{compradores}', 'CompradoresController@show');
        Route::put('compradores/{compradores}', 'CompradoresController@update');
        Route::post('compradores', 'CompradoresController@store');
        Route::delete('compradores/{compradores}', 'CompradoresController@destroy');

              //demandas
      
        Route::put('demandas/{empresas}/{demandas}', 'DemandasController@update');
        Route::post('demandas', 'DemandasController@store');
      });

Route::group(['middleware' => ['role:superadmin|vendedores|comissionados'],'auth:api','namespace' => 'Api'], function () {

   

      //vendedores
      Route::get('vendedores/{empresas}', 'VendedoresController@index');
      Route::get('vendedor/{empresas}/{vendedores}', 'VendedoresController@show');
      Route::put('vendedores/{empresas}/{vendedores}', 'VendedoresController@update');
      Route::post('vendedores', 'VendedoresController@store');
      Route::post('buscavendedorporusuario/{empresas}', 'VendedoresController@buscaporusuario');
      Route::delete('vendedores/{vendedores}', 'VendedoresController@destroy');

      
 Route::put('ofertas/{empresas}/{ofertas}', 'OfertasController@update');
 Route::post('ofertas', 'OfertasController@store');


});

