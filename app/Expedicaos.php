<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $fechamento_id
 * @property int $motoristas_id
 * @property int $veiculos_id
 * @property string $disponibilidade
 * @property string $datasaida
 * @property boolean $emrecepcao
 * @property Fechamento $fechamento
 * @property Motorista $motorista
 * @property Veiculo $veiculo
 * @property Expedicao[] $expedicaos
 */
class Expedicaos extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['empresas_id','fechamento_id','produtos_id', 'motoristas_id', 'veiculos_id', 'disponibilidade', 'datasaida', 'emrecepcao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fechamento()
    {
        return $this->belongsTo('App\Fechamentos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function motorista()
    {
        return $this->belongsTo('App\Motoristas', 'motoristas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function veiculo()
    {
        return $this->belongsTo('App\Veiculos', 'veiculos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expedicaos()
    {
        return $this->hasMany('App\Expedicao');
    }

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produto()
    {
        return $this->belongsTo('App\Produtos', 'produtos_id');
    }
}
