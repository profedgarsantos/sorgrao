<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $valor
 * @property Vendedore[] $vendedores
 */
class Funrurals extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['descricao','valor'];
    
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendedores()
    {
        return $this->hasMany('App\Vendedores');
    }
}
