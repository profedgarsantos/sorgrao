<?php

namespace App\Http\Controllers\Api;

use App\Ofertas;
use App\Empresas;
use App\Vendedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OfertasController extends Controller
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

        //dd($user);
        if ($user->grupos_id==1 || $user->grupos_id==4) //admin e comissionado vem tudo
        {
            //dd("aqio");
            $items=Ofertas::where("empresas_id",$empresaid)->where("cancelado",0)->get();
        }

        if ($user->grupos_id==2) //compradores ve só os deles
        {
            dd("dd");
            $items=Vendedores::where("empresas_id",1)->where("usuario_id",$user->id)->first()->ofertas()->where("cancelado",0)->get();
        }
        

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
        $items=Ofertas::create($request->all());

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
        $items=Ofertas::where("id",$id)->where("empresas_id",$empresaid)->first();

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
    public function update(Request $request, $empresaid, $id)
    {

        $demanda=Ofertas::where("id",$id)->where("empresas_id",$empresaid)->first();

        $demanda->fill($request->all());

        $demanda->save();

        return responder()
            ->success()
            ->respond();
    }

         public function busca(Request $request,$empresaid)
    {

        $produtos_id  = $request->get('produtos_id');
        $vendedores_id = $request->get('vendedores_id');
        $status = $request->get('status');

        $items=Ofertas::where("empresas_id",$empresaid);       

            if($vendedores_id!="0"){
                $items=$items->where('vendedores_id',$vendedores_id);
            }

            if($produtos_id!="0"){
               $items=$items->where('produtos_id',$produtos_id);
            }

             if($status!="3"){
               $items=$items->where('cancelado',$status);
            }

            $items->get();

        return responder()
            ->success($items, $this->transformer());


        }




   
    private function transformer()
    {
          return function ($item) {
            return [
                'id' => $item->id,
                'quantidade' => $item->quantidade,
                'valorunitario' => $item->valorunitario,
                'valorunitariorevenda' => $item->valorunitariorevenda,
                'validade' => $item->validade,
                'tipoentrega' => $item->tipoentrega,
                'capacidadeexpedicao' => $item->capacidadeexpedicao,
                'cancelado' => $item->cancelado,
                'vendedores_id' => $item->vendedores_id,
                'nomevendedor' => $item->NomeVendedor,
                'cidadevendedor' => $item->vendedor->user->cidade->nome,
                'estadovendedor' =>$item->vendedor->user->cidade->estado->nome,
                'distanciavendedor' => $item->distanciavendedor,
                'valorfunrural' => $item->ValorFunrural,
                'produto' => $item->produto,               
                'empresas_id' => $item->empresas_id,
                'nomeempresa' => $item->NomeEmpresa,
                "calculadora"=> $item->GetCalculadora,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at

            ];
        };

    }
}
