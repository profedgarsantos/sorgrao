<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Fechamentos;


class FechamentosController extends Controller
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
        $items=Fechamentos::where("empresas_id",$empresaid)->get();

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
        $items=Fechamentos::create($request->all());

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
    public function show($id)
    {
        $items=Fechamentos::where("id",$id)->first();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

      public function buscaporofertademanda(Request $request,$empresaid)
    {

        $oferta_id  = $request->get('oferta_id');
        $demanda_id = $request->get('demanda_id');

        $items=Fechamentos::where("empresas_id",$empresaid);       
        $items=$items->where('oferta_id',$oferta_id);
        $items=$items->where('demanda_id',$demanda_id);
           
        $items->first();

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
    public function update(Request $request,$empresaid,$id)
    {

        
        $fechamento=Fechamentos::where("id",$id)->where("empresas_id",$empresaid)->first();

        $fechamento->fill($request->all());

        $fechamento->save();

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
        $items=Fechamentos::where("id",$id)->where("empresasid",$empresaid)->first();
        $items->delete();

        return responder()
            ->success()
            ->respond();



        //
    }
    
    public function gerarpedido($empresaid,$id)
    {
        return response()->download('pedido.php?fechamento=1');
        
    }




    private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'oferta_id' => $item->oferta_id,
                'demanda_id' => $item->demanda_id,
                'comissionado_id' => $item->comissionado_id,
                'nomecomissionado' => $item->NomeComissionado,
                'nomevendedor' => $item->NomeVendedor,
                'nomecomprador' => $item->NomeComprador,
                'valorunitario' => $item->valorunitario,
                'quantidade' => $item->quantidade,
                'valorfinal' => $item->valorfinal,
                'valorcomissionado' => $item->valorcomissionado,
                'inicioentrega' => $item->inicioentrega,
                'fimentrega' => $item->fimentrega,
                'created_at' => $item->created_at                
            ];
        };

    }
}
