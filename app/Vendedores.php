<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $usuario_id
 * @property int $funrural_id
 * @property string $inscricaoestadual
 * @property string $cnpj
 * @property float $funrural
 * @property Funrural $funrural
 * @property User $user
 * @property Oferta[] $ofertas
 */



class Vendedores extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['usuario_id','nomebanco','numerobanco','agencia','contacorrente','funrural_id','empresas_id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
 
    public function getGetUsuarioAttribute()
    {

           $user=$this->user;

			return $user;
    }

    public function getValorFunruralAttribute()
    {

           $vlrfunrural=$this->funrural->valor;

			return $vlrfunrural;
    }

    public function getDescFunruralAttribute()
    {

           $vlrfunrural=$this->funrural->descricao;

			return $vlrfunrural;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'usuario_id');
    }


    public function funrural()
    {
        return $this->belongsTo('App\Funrurals', 'funrural_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ofertas()
    {
        return $this->hasMany('App\Ofertas', 'vendedor_id');
    }
}
