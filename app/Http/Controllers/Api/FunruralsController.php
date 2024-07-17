<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresas;
use App\Funrurals;


class FunruralsController extends Controller
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
     
        $items=Funrurals::all();

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

        $funrural=request()->only(['descricao','valor']);
        //dd($funrural);
       $items=Funrurals::create($funrural);

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
        $items=Funrurals::where("id",$id)->get();

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
        $funrural = Funrurals::findOrFail($id);
       
          $funrural=request()->only(['descricao','valor']);

        $funrural->save();

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
    public function destroy($id)
    {
        $items=Funrurals::findorFail($id)->first();
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
                'descricao' => $item->descricao,
                'valor' => $item->valor
            ];
        };

    }
}
