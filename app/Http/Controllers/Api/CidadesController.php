<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cidades;
use App\Estados;

class CidadesController extends Controller
{

    public function __construct()
    {
      //$this->middleware('auth:api');
    }

    public function index(Estados $estados)
    {

       // dd($estados->id);

        $items=Cidades::where("estados_id",$estados->id)->get();
        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cidades $cidades)
    {

        //dd($cidades->id);

        $items=Cidades::where("id",$cidades->id)->first();
        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }


    private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'nome' => $item->nome,
                'estados_id' => $item->estados_id,
                'nomeestado' => $item->NomeEstado
            ];
        };

    }
}
