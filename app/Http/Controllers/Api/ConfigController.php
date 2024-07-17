<?php

namespace App\Http\Controllers\Api;

use App\Configs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
   
    
    public function __construct()
        {
     
          // $this->middleware(['role:superadmin']);
        }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresaid)
    {

        $items=Configs::where("empresas_id",$empresaid)->first();
        return $items;

    }

    public function update(Request $request,$empresaid)
    {
        

        $config=Configs::where("empresas_id",$empresaid)->first();

        $config->fill($request->all());

        $config->save();

        return responder()
            ->success()
            ->respond();
    }
}
