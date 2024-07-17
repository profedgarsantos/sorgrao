<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Motoristas;
use App\Vendedores;
use App\Compradores;
use App\Comissionados;
use App\Transportadoras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function register(Request $request)
    {
      //dd($request->all());
      $user = new User();      
      $user->name = $request->name;
      $user->email = $request->email;
      $user->logradouro = $request->logradouro;
      $user->cep = $request->cep;
      $user->numero = $request->numero;
       $user->bairro = $request->bairro;
      $user->telefone = $request->telefone;
      $user->celular = $request->celular;
      $user->cnpjcpf = $request->cnpjcpf;
      $user->cidades_id = $request->cidades_id;
      $user->grupos_id = $request->grupos_id;
      $user->empresas_id = $request->empresas_id;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();

//dd($user->id);
      
      switch($request->grupos_id)
      {
          case "2":
             $compradores= Compradores::create([
              'usuario_id' => $user->id,
              'empresas_id' => "1",
             ]);
             $user->assignRole('compradores');
          break;

          case "3":
          $vendedores= Vendedores::create([
           'usuario_id' => $user->id,
           'funrural_id' => $request->funrural_id,
           'nomebanco' => $request->nomebanco,
           'numerobanco' => $request->numerobanco,
           'agencia' => $request->agencia,
           'contacorrente' => $request->contacorrente,
           'empresas_id' => "1",
            ]);
            $user->assignRole('vendedores');

         break;

         case "4":
         $comissionados= Comissionados::create([
          'nomebanco' => $request->nomebanco,
          'numerobanco' => $request->numerobanco,
          'agencia' => $request->agencia,
          'contacorrente' => $request->contacorrente,
          'usuario_id' => $user->id,
          'empresas_id' => "1",
         ]);
         $user->assignRole('comissionados');
         break;

         case "5":
         $transportadoras= Transportadoras::create([
          'usuario_id' => $user->id,
          'empresas_id' => "1",
         ]);
         break;

         case "6":
         $motoristas= Motoristas::create([
          'usuario_id' => $user->id,
          'transportadora_id' => $request->transpostadora_id,
          'empresas_id' => "1",
         ]);
         break;

      }

      

      $token = auth()->login($user);

      return $this->respondWithToken($token,$user);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

        $userlogin=User::where("email",$request->get("email"))->first();
        return $this->respondWithToken($token,$userlogin);
    }

    protected function respondWithToken($token,$user)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60,
        'user' => $user,
        'estado'=>$user->cidade->estado
        
      ]);
    }
}
