<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Produtos;



class ProdutosController extends Controller
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
     
        $items=Produtos::where("empresas_id",$empresaid)->get();

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

        $produto=request()->only(['nome','tipounidade','empresas_id','tiposfretes_id']);
        //dd($produto);
       $items=Produtos::create($produto);

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
        $items=Produtos::where("id",$id)->where("empresas_id",$empresaid)->first();

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
        $produto = Produtos::where("id",$id)->where("empresas_id",$empresaid)->first();
       
        $produto->fill(request()->only(['nome','tipounidade','tiposfretes_id']));

        $produto->save();

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
        $produto = Produtos::where("id",$id)->where("empresas_id",$empresaid)->first();
       
        $produto->cancelado=1;

        $produto->save();

        return responder()
            ->success()
            ->respond();
    }


    private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'nome' => $item->nome,
                'tipounidade' => $item->tipounidade,
                'empresas_id' => $item->empresas_id,
                'tiposfretes_id' => $item->tiposfretes_id,
                'nometiposfretes' => $item->NomeTipoFrete
            ];
        };

    }
}
