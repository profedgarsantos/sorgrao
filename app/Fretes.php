<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $distanciainicial
 * @property int $distanciafinal
 * @property float $valorfrete
 * @property Veiculo[] $veiculos
 */
class Fretes extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['distanciainicial', 'distanciafinal', 'valorfrete','tiposfretes_id'];


    
    public function getNomeTipoFreteAttribute(): string
    {
       
            $nometipofrete=$this->tipofrete->name;
		    return $nometipofrete;        
       
    }

    public function tipofrete()
    {
        return $this->belongsTo('App\TiposFretes', 'tiposfretes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function veiculos()
    {
        return $this->hasMany('App\Veiculo');
    }
}
