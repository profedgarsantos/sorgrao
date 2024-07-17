<?php

namespace App\Http\Controllers\api;

use App\Tiposfretes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiposFretesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
     
        $items=Tiposfretes::all();

        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }

     private function transformer()
    {
        return function ($item) {
            return [
                'id' => $item->id,
                'nome' => $item->nome
            ];
        };

    }

}
