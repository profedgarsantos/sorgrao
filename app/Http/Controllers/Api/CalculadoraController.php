<?php

namespace App\Http\Controllers\api;

use App\Ofertas;
use App\Calculadora;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculadoraController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $items=Calculadora::all();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        //dd($calculadora);
        $items=Calculadora::create($request->all());

        //salva o valor final da calculadora no campo 'valorunitariorevenda' na tabela de ofertas
        $oferta=Ofertas::where("id",$request->get("ofertas_id"))->first();

        //dd($oferta);
        $oferta->valorunitariorevenda=$request->get("valorfinal");
        $oferta->save();


        return responder()
            ->success()
            ->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ofertaid)
    {
        $items=Calculadora::where("ofertas_id",$ofertaid)->first();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $calculadora = Calculadora::where("id",$id)->first();
       
        $calculadora->fill($request->all());

        $calculadora->save();

         //salva o valor final da calculadora no campo 'valorunitariorevenda' na tabela de ofertas
         $oferta=Ofertas::where("id",$request->get("ofertas_id"))->first();
         $oferta->valorunitariorevenda=$request->get("valorfinal");
         $oferta->save();

        return responder()
            ->success()
            ->respond();
    }

    private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'comissionado_id' => $item->comissionado_id,
                'nomecomissionado' => $item->NomeComissionado,
                'valorcomissionado' => $item->valorcomissionado,
                'valoroferta' => $item->valoroferta,
                'valorfunrural' => $item->valorfunrural,
                'valorfinal' => $item->valorfinal,
                'ofertas_id' => $item->ofertas_id
            ];
        };

    }
}
