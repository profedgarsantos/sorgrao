<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $transportadora_id
 * @property int $frete_id
 * @property string $placa
 * @property string $capacidade
 * @property Frete $frete
 * @property Transportadora $transportadora
 * @property Logistica[] $logisticas
 */
class Veiculos extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['transportadoras_id','modelo','ativo', 'frete_id', 'placa', 'capacidade'];


    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frete()
    {
        return $this->belongsTo('App\Fretes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportadora()
    {
        return $this->belongsTo('App\Transportadoras',"transportadoras_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logisticas()
    {
        return $this->hasMany('App\Logisticas', 'veiculos_id');
    }
}
