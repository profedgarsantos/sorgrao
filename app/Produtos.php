<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $tipoproduto
 * @property Demanda[] $demandas
 * @property Expedicao[] $expedicaos
 */
class Produtos extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id','nome','tipounidade','empresas_id','tiposfretes_id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function demandas()
    {
        return $this->hasMany('App\Demandas');
    }

    public function getNomeTipoFreteAttribute(): string
    {
       
            $nometipofrete=$this->tipofrete->nome;
		    return $nometipofrete;
        
       
    }
    public function tipofrete()
    {
        return $this->belongsTo('App\Tiposfretes', 'tiposfretes_id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresas_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expedicaos()
    {
        return $this->hasMany('App\Expedicao', 'produtos_id');
    }
}
