<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $nome
 * @property Cidade[] $cidades
 * @property Estado[] $estados
 */
class Paises extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cidades()
    {
        return $this->hasMany('App\Cidade', 'paises_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estados()
    {
        return $this->hasMany('App\Estado', 'paises_id');
    }
}
