<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nome
 * @property Frete[] $fretes
 * @property Produto[] $produtos
 */
class Tiposfretes extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nome'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fretes()
    {
        return $this->hasMany('App\Fretes', 'tiposfretes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produtos()
    {
        return $this->hasMany('App\Produtos', 'tiposfretes_id');
    }
}
