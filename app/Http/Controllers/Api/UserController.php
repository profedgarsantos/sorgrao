<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Empresas;
use App\Vendedores;
use App\Comissionados;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Validator;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
      public function __construct()
    {
        //$user=auth()->user();
        //$user->assignRole('superadmin');
        $this->middleware("cors");
       
    }

    public function index($empresaid)
    {

        $items=User::where("empresas_id",$empresaid)->get();  
        return responder()
            ->success($items, $this->transformer());
        }


        public function busca(Request $request,$empresaid)
    {

        $grupos_id  = $request->get('grupos_id');
        $nome  = $request->get('nome');

        $items=User::where("empresas_id",$empresaid);       

            if($grupos_id){
                $items=$items->where('grupos_id',$grupos_id);
            }

            if($nome){
                $items =$items->where('name' ,'like', '%'.$nome.'%');
            }

            $items->get();

        return responder()
            ->success($items, $this->transformer());


        }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items=User::where("id",$id)->first();
        return responder()
            ->success($items, $this->transformer())
            ->respond();
    }


    public function admin_credential_rules(array $data)
{
  $messages = [
    'current-password.required' => 'Please enter current password',
    'password.required' => 'Please enter password',
  ];

  $validator = Validator::make($data, [
    'current-password' => 'required',
    'password' => 'required|same:password',
    'password_confirmation' => 'required|same:password',     
  ], $messages);

  return $validator;
}  

public function PegarSenha($attribute, $value)
{
    $current_password = auth()->user()->password;
    return Hash::check($value, $current_password);
}

public function MudarSenha(Request $request)
{
  if(Auth::Check())
  {
    $request_data = $request->All();
    $validator = $this->admin_credential_rules($request_data);
    if($validator->fails())
    {
      return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
    }
    else
    {  
      $current_password = Auth::User()->password;           
      if(Hash::check($request_data['current-password'], $current_password))
      {           
        $user_id = Auth::User()->id;                       
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($request_data['password']);;
        $obj_user->save(); 
        return "ok";
      }
      else
      {           
        $error = array('current-password' => 'Please enter correct current password');
        return response()->json(array('error' => $error), 400);   
      }
    }        
  }
  else
  {
    return redirect()->to('/');
  }    
}
    public function update(Request $request,$empresaid,$id)
    {

        $user = User::findOrFail($id);

        

       // dd(Hash::make($request->get("password")));
       
        $user->fill(request()->only(['name','cep','logradouro','ativo', 'bairro','inscricaoestadual','inscricaomunicipal','numero', 'telefone', 'celular', 'cnpjcpf', 'cidades_id', 'grupos_id']));

        if ($request->get("password")!="")
        {
          $user["password"]= Hash::make($request->get("password"));
        }

        //dd($user);
        $user->save();
      


        switch($request->grupos_id)
      {
          case "3":     
          $vendedor = Vendedores::where("usuario_id",$id)->first();
          $vendedor->fill(request()->only(['nomebanco','numerobanco','agencia','contacorrente','funrural_id']));
          $vendedor->save();
          break;

         case "4":
         $comissionado = Comissionados::where("usuario_id",$id)->first();
         $comissionado->fill(request()->only(['nomebanco','numerobanco','agencia','contacorrente']));
         $comissionado->save();
         break;

      }

      
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function transformer()
    {

   
        return function ($item) {
                if ($item->grupos_id==6)
            {
  return [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'cep' => $item->cep,
                'logradouro' => $item->logradouro,
                'numero' => $item->numero,
                'bairro' => $item->bairro,
                'telefone' => $item->telefone,
                'ativo' => $item->ativo,
                'celular' => $item->celular,
                'inscricaomunicipal' => $item->inscricaomunicipal,
                'inscricaoestadual' => $item->inscricaoestadual,
                'cnpjcpf' => $item->cnpjcpf,
                'grupos_id' => $item->grupos_id,
                'nomegrupo' => $item->NomeGrupo,
                'empresas_id' => $item->empresas_id,
                'email' => $item->email,
                'cidade'=>$item->cidade,
                'estado'=>$item->cidade->estado,
                'transportadora_id'=>$item->GetIdTransportadora,
                'nometransportadora'=>$item->GetNomeTransportadora            
            ];
            }
            else
            {
                 return [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'cep' => $item->cep,
                'logradouro' => $item->logradouro,
                'numero' => $item->numero,
                'bairro' => $item->bairro,
                'telefone' => $item->telefone,
                'ativo' => $item->ativo,
                'celular' => $item->celular,
                'inscricaomunicipal' => $item->inscricaomunicipal,
                'inscricaoestadual' => $item->inscricaoestadual,
                'cnpjcpf' => $item->cnpjcpf,
                'cidade'=>$item->cidade,
                'estado'=>$item->cidade->estado,
                'grupos_id' => $item->grupos_id,
                'nomegrupo' => $item->NomeGrupo,
                'empresas_id' => $item->empresas_id,
                'email' => $item->email,
                'vendedor'=>$item->vendedor,
                'comissionado'=>$item->comissionado
            ];
        }
        };

    }
}
