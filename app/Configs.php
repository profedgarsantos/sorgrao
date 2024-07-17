<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $numerobanco
 * @property string $nomebanco
 * @property string $agencia
 * @property string $contacorrente
 */
class Configs extends Model
{
    /**
     * @var array
     */

    public $timestamps = false;
    protected $fillable = ['empresas_id','numerobanco', 'nomebanco', 'agencia', 'contacorrente'];

}
