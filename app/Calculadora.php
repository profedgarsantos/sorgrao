<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $ofertas_id
 * @property int $comissionados_id
 * @property float $valorfrete
 * @property float $valorcomissionado
 * @property float $valoroferta
 * @property float $valorfunrural
 * @property float $valorfinal
 * @property string $created_at
 * @property string $updated_at
 * @property Oferta $oferta
 */
class Calculadora extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'calculadora';

    /**
     * @var array
     */
    protected $fillable = ['id','ofertas_id', 'comissionados_id', 'valorfrete', 'valorcomissionado', 'valoroferta', 'valorfunrural', 'valorfinal', 'created_at', 'updated_at'];

    
      public function getNomeComissionadoAttribute(): string
    {
        if ($this->comissionados_id!=0)
        {
            $nomecomissionado=$this->comissionado->user->name;
		    return $nomecomissionado;
        }
        else{
            return "Nenhum Comissionado";
        }
       
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function oferta()
    {
        return $this->belongsTo('App\Ofertas', 'ofertas_id');
    }

    public function comissionado()
    {
        return $this->belongsTo('App\Comissionados', 'comissionados_id','id','comissionados_id');
    }
}
