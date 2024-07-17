<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $transportadora_id
 * @property int $usuario_id
 * @property Transportadora $transportadora
 * @property User $user
 * @property Logistica[] $logisticas
 */
class Motoristas extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['transportadoras_id', 'usuario_id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportadora()
    {
        return $this->belongsTo('App\Transportadoras','transportadora_id');
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
    public function logisticas()
    {
        return $this->hasMany('App\Logistica', 'motoristas_id');
    }
}
