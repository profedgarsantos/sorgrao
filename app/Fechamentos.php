<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $oferta_id
 * @property int $demanda_id
 * @property int $quantidade
 * @property float $valorunitario
 * @property float $valorfinal
 * @property string $inicioentrega
 * @property string $fimentrega
 * @property float $valorcomissionado
 * @property Demanda $demanda
 * @property Oferta $oferta
 * @property Expedicao[] $expedicaos
 * @property Logistica[] $logisticas
 * @property Transportadora[] $transportadoras
 */
class Fechamentos extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id','comissionados_id','empresas_id','oferta_id', 'demanda_id', 'quantidade', 'valorunitario', 'valorfinal', 'inicioentrega', 'fimentrega', 'valorcomissionado'];


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

    public function getNomeCompradorAttribute()
    {

       
            $nomecomprador=$this->demanda->nomecomprador;
		    return $nomecomprador;   
       
    }


    public function getNomeVendedorAttribute()
    {
                   
            $nomevendedor=$this->oferta->nomevendedor;
		    return $nomevendedor;   
       
    }

       /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comissionado()
    {
       return $this->belongsTo('App\Comissionados', 'comissionados_id','id','comissionados_id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function demanda()
    {
        return $this->belongsTo('App\Demandas', 'demanda_id','id','demanda_id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function oferta()
    {
        return $this->belongsTo('App\Ofertas', 'oferta_id','id','oferta_id');
    }

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expedicaos()
    {
        return $this->hasMany('App\Expedicao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logisticas()
    {
        return $this->hasMany('App\Logistica');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function transportadoras()
    {
        return $this->belongsToMany('App\Transportadora', 'transportadoras_fechamento', null, 'transportadoras_id');
    }
}
