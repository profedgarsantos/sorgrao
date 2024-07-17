<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $paises_id
 * @property int $nome
 * @property Paise $paise
 * @property Cidade[] $cidades
 */
class Estados extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['paises_id', 'nome'];


    public function getNomeEstadoAttribute(): string
    {

        $nomepais=$this->paise->nome;

        return $nomepais;
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
    public function cidades()
    {
        return $this->hasMany('App\Cidade', 'estados_id');
    }
}
