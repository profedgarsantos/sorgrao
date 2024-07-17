<?php

namespace App\Http\Controllers\Api;

use App\Demandas;
use App\Empresas;
use App\Compradores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DemandasController extends Controller
{


   
   
    // dd($user->hasRole('compradores'));
   
    public function __construct()
    {
        //$user=auth()->user();
        //$user->assignRole('superadmin');
        $this->middleware("cors");
       
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
            $items=Demandas::where("empresas_id",$empresaid)->where("cancelado",0)->get();
        }     

        if ($user->grupos_id==2) //compradores ve só os deles
        {
            $items=Compradores::where("empresas_id",1)->where("usuario_id",$user->id)->first()->demandas()->where("cancelado",0)->get();
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
        $items=Demandas::create($request->all());

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
        $items=Demandas::where("id",$id)->where("empresas_id",$empresaid)->first();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

        public function busca(Request $request,$empresaid)
    {

        $produtos_id  = $request->get('produtos_id');
        $compradores_id = $request->get('compradores_id');
        $status = $request->get('status');

        $items=Demandas::where("empresas_id",$empresaid);       

            if($compradores_id!="0"){
                $items=$items->where('compradores_id',$compradores_id);
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



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $empresaid, $id)
    {

        $demanda=Demandas::where("id",$id)->where("empresas_id",$empresaid)->first();

        $demanda->fill($request->all());

        $demanda->save();

        return responder()
            ->success()
            ->respond();
    }

    private function transformer()
    {
          return function ($item) {
            return [
                'id' => $item->id,
                'quantidade' => $item->quantidade,
                'valorunitario' => $item->valorunitario,
                'validade' => $item->validade,
                'finalizado' => $item->finalizado,
                'capacidaderecepcao' => $item->capacidaderecepcao,
                'cancelado' => $item->cancelado,
                'compradores_id' => $item->compradores_id,
                'nomecomprador' => $item->NomeComprador,
                'cidadecomprador' => $item->comprador->user->cidade->nome,
                'estadocomprador' =>$item->comprador->user->cidade->estado->nome,
                'produtos_id' => $item->produtos_id,
                'nomeproduto' => $item->NomeProduto,                
                'empresas_id' => $item->empresas_id,
                'nomeempresa' => $item->NomeEmpresa,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at

            ];
        };

    }
}
