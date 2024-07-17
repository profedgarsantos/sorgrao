<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $estados_id
 * @property int $paises_id
 * @property int $nome
 * @property Estado $estado
 * @property Paise $paise
 * @property Empresa[] $empresas
 * @property User[] $users
 */
class Cidades extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['estados_id', 'paises_id', 'nome'];



    public function getNomeEstadoAttribute(): string
    {

        $nomeestado=$this->estado->nome;

        return $nomeestado;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo('App\Estados', 'estados_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paise()
    {
        return $this->belongsTo('App\Paise', 'paises_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresas()
    {
        return $this->hasMany('App\Empresa', 'cidades_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'cidades_id');
    }
}
