<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $usuario_id
 * @property string $inscricaoestadual
 * @property string $cnpj
 * @property User $user
 * @property Demanda[] $demandas
 */
class Compradores extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
     public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['empresas_id','usuario_id'];


    public function getGetUsuarioAttribute()
    {

        

		    $user=$this->user;

			return $user;
    }

   public function getNomeEmpresaAttribute(): string
    {

		    $nomeempresa=$this->empresa->nome;

			return $nomeempresa;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'usuario_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandas()
    {
        return $this->hasMany('App\Demandas', 'compradores_id');
    }
}
