<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Estados;
use App\Paises;

class EstadosController extends Controller
{

    
    public function __construct()
        {
            $this->middleware("cors");
        }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pais)
    {

        //dd($paises->id);

        $items= Estados::where("paises_id",$pais)->get();
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
    public function show(Estados $estados)
    {
        //dd($estados->id);

        $items= Estados::where("id",$estados->id)->get();
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
                'pais_id' => $item->pais_id,
                'nomepais' => $item->NomePais
            ];
        };

    }


}
