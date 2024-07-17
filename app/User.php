<?php

namespace App;

use App\Motoristas;
use App\Transportadoras;
use App\Vendedores;
use App\Comissionados;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    use HasRoles;

    protected $guard_name = 'api';

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var array
     */
    protected $fillable = ['id','cidades_id', 'cep', 'nomebanco','numerobanco','agencia','contacorrente','empresas_id','inscricaoestadual','inscricaomunicipal','grupos_id', 'ativo','name', 'email', 'email_verified_at', 'password', 'nome', 'logradouro', 'numero', 'bairro','telefone', 'celular', 'cnpjcpf', 'remember_token'];


    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }
    

    public function getNomeGrupoAttribute(): string
    {
		    $nomegrupo=$this->grupo->nome;

			return $nomegrupo;
    }

    public function getNomeCidadeAttribute(): string
    {
		    $nomecidade=$this->cidade->nome;

			return $nomecidade;
    }

    public function getNomeEstadoAttribute(): string
    {
		    $nomeestado=$this->cidade->estado->nome;

			return $nomeestado;
    }

    public function getEstadoIdAttribute(): string
    {
		    $estadoid=$this->cidade->estado->id;

			return $estadoid;
    }

     public function getGetNomeTransportadoraAttribute(): string
    {

            $motorista=Motoristas::where("usuario_id",$this->id)->first();
            //dd($transportadora->transportadora_id);
            if ($motorista->transportadora!=null)
            {
            return $motorista->transportadora->user->name;
            }
            else
            {
                return null;
            }
    }

    
     public function getGetIdTransportadoraAttribute(): string
    {

            $motorista=Motoristas::where("usuario_id",$this->id)->first();
            //dd($transportadora->transportadora_id);
            if ($motorista->transportadora!=null)
            {
            return $motorista->transportadora->id;
            }
            else
            {
                return null;
            }
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cidade()
    {
        return $this->belongsTo('App\Cidades', 'cidades_id');
    }


    public function vendedor()
    {
        return $this->belongsTo('App\Vendedores', 'id','usuario_id','id');
    }

    public function comissionado()
    {
        return $this->belongsTo('App\Comissionados', 'id','usuario_id','id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresas_id');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Grupos', 'grupos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comprador()
    {
        return $this->belongsTo('App\Compradores', 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function motoristas()
    {
        return $this->hasMany('App\Motoristas', 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transportadora()
    {
        return $this->hasMany('App\Transportadoras', 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores()
    {
        return $this->hasMany('App\Vendedores', 'usuario_id');
    }

    public function comissionados()
    {
        return $this->hasMany('App\Comissionados', 'usuario_id');
    }


}
