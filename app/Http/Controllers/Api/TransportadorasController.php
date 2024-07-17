<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Transportadoras;


class TransportadorasController extends Controller
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
    public function index($empresaid)
    {
        $items=Transportadoras::where("empresas_id",$empresaid)->get();

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
        $items=Transportadoras::create($request->all());

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
    public function show($empresaid,$id)
    {
        $items=Transportadoras::where("id",$id)->where("empresas_id",$empresaid)->get();

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
        $transportadoras = new Transportadoras($items);
        $transportadoras->save();

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
    public function destroy($empresaid,$id)
    {
        $items=Transportadoras::where("id",$id)->where("empresas_id",$empresaid)->get();
        $items->delete();

        return responder()
            ->success()
            ->respond();



        //
    }


    private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'user' => $item->user
            ];
        };

    }
}
