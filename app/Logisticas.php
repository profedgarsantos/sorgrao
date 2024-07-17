<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $logistica_id
 * @property int $fechamento_id
 * @property int $produtos_id
 * @property string $datarecepcao
 * @property int $pesoliquido
 * @property int $quantidade
 * @property string $notafiscal
 * @property Fechamento $fechamento
 * @property Logistica $logistica
 * @property Produto $produto
 */
class Logisticas extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['expedicao_id', 'fechamento_id', 'produtos_id','empresas_id', 'datarecepcao', 'pesoliquido', 'notafiscal'];

    public $timestamps = false;
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
    public function logistica()
    {
        return $this->belongsTo('App\Logisticas');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produto()
    {
        return $this->belongsTo('App\Produtos', 'produtos_id');
    }
}
