<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Vendedores;


class VendedoresController extends Controller
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
        $user=auth()->user();
        if ($user->grupos_id==1 || $user->grupos_id==4) //admin e comissionado vem tudo
        {
            $items=Vendedores::where("empresas_id",$empresaid)->get();
        }

        if ($user->grupos_id==3) //vendedores ve só os deles
        {
            $items=Vendedores::where("empresas_id",$empresaid)->where("usuario_id",$user->id)->first();
        }

       return responder()
        ->success($items, $this->transformer())
        ->respond();
    }

    public function buscaporusuario(Request $request,$empresasid)
    {

        $usuarioid=$request->get("usuario_id");
        
        $items=Vendedores::where("empresas_id",$empresasid)->where("usuario_id",$usuarioid)->first();
         
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
        $items=Vendedores::create($request->all());

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
        $items=Vendedores::where("id",$id)->where("empresa_id",$empresa->id)->first();

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
    public function update(Request $request,$empresasid, $id)
    {
        $vendedores=Vendedores::where("id",$id)->where("empresas_id",$empresasid)->first();
        
        $vendedores->fill(request()->only(['funrural_id']));

        $vendedores->save();

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
    public function destroy($empresasid,$id)
    {
        $items=Vendedores::where("id",$id)->where("empresas_id",$empresasid)->first();
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
                'numerobanco' => $item->numerobanco,
                'nomebanco' => $item->nomebanco,
                'agencia' => $item->agencia,
                'contacorrente' => $item->contacorrente,
                'funrural_id' => $item->funrural_id,
                'valorfunrural' => $item->ValorFunrural,
                'descfunrural' => $item->DescFunrural,
                'usuario_id' => $item->usuario_id,
                'user' => $item->GetUsuario
            ];
        };

    }
}
