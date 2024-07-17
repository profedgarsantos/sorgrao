<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $produto_id
 * @property int $comprador_id
 * @property int $quantidade
 * @property float $valorapagar
 * @property string $validade
 * @property boolean $finalizado
 * @property boolean $cancelado
 * @property string $capacidaderecepcao
 * @property Compradores $compradore
 * @property Produto $produto
 * @property Fechamento[] $fechamentos
 */
class Demandas extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['empresas_id','compradores_id','produtos_id', 'comprador_id', 'quantidade', 'valorunitario', 'validade', 'finalizado', 'cancelado', 'capacidaderecepcao'];
    
    public function getNomeProdutoAttribute(): string
    {
        $nomeproduto=$this->produto->nome . " - ".$this->produto->tipounidade;


			return $nomeproduto;
    }

    public function getNomeCompradorAttribute(): string
    {

		    $nomecomprador=$this->comprador->user->name;

			return $nomecomprador;
    }

    public function getNomeEmpresaAttribute(): string
    {

		    $nomeempresa=$this->empresa->nome;

			return $nomeempresa;
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresas', 'empresas_id');
    }

    public function comprador()
    {
        return $this->belongsTo('App\Compradores', 'compradores_id',"id","compradores_id");
    }

    public function compradores()
    {
        return $this->hasMany('App\Compradores', 'compradores_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produto()
    {
        return $this->belongsTo('App\Produtos', 'produtos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fechamentos()
    {
        return $this->hasMany('App\Fechamento');
    }
}
