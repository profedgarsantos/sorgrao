<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Comissionados;


class ComissionadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresaid)
    {
        $items=Comissionados::where("empresas_id",$empresaid)->get();

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
        // pegar dados do formulario
        $items=Comissionados::create($request->all());

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
    public function show(Empresas $empresa,$id)
    {
        $items=Comissionados::where("id",$id)->where("empresas_id",$empresa->id)->first();

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
        $items=$request->all();
        $comissionados = new Comissionados($items);
        $comissionados->save();

        return responder()
            ->success()
            ->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresas $empresa,$id)
    {
        $items=Comissionados::where("id",$id)->where("empresas_id",$empresa->id)->get();
        $items->delete();

        return responder()
            ->success()
            ->respond();
    }

    private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'numerobanco' => $item->numerobanco,
                'nomebanco' => $item->nomebanco,
                'agencia' => $item->agencia,
                'contacorrente' => $item->contacorrente,
                'inscricaoestadual' => $item->inscricaoestadual,
                'cnpj' => $item->cnpj,
                'user' => $item->user
            ];
        };

    }
}
