<?php

namespace App;

use App\Fretes;
use App\Tiposfretes;
use App\Comissionados;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idoferta
 * @property int $vendedor_id
 * @property int $quantidade
 * @property float $valorunitario
 * @property string $validade
 * @property boolean $cancelado
 * @property string $tipoentrega
 * @property string $capacidadeexpedicao
 * @property Vendedore $vendedore
 * @property Fechamento[] $fechamentos
 */
class Ofertas extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['id','empresas_id','vendedores_id','distanciavendedor','produtos_id','quantidade','valorunitariorevenda', 'valorunitario', 'validade', 'cancelado', 'tipoentrega', 'capacidadeexpedicao'];

     public function getGetCalculadoraAttribute()
    {

            $calculadora=$this->calculadora;
            // $cd=$calculadora["comissionados_id"];
             //dd($cd);

            if ($calculadora["comissionados_id"]==0)
            {
                //dd("aqui");
               $calculadora["nomecomissionado"]="Nenhum Comissionado";                
            }
            else
            {
              
                
               // dd($calculadora["comissionados_id"]);

                $comissionado=Comissionados::where("id",$calculadora["comissionados_id"])->first();
                //dd($calculadora["comissionados_id"]);
                $calculadora["nomecomissionado"]=$comissionado->user->name;
                

            }

            /*
            if ($this->distanciavendedor)
            {
                $valortipofrete=Fretes::where("tiposfretes_id",$this->produto->tiposfretes_id)->where("distanciainicial","<=",$this->distanciavendedor)->where("distanciafinal",">=",$this->distanciavendedor)->first();
           
            
                 if ($valortipofrete)
                 {
                      // dd($valortipofrete);
                      $calculadora["valorfrete"]=$valortipofrete->valorfrete;
                 }
            }
           else
            {
                $calculadora["valorfrete"]=0;

            }
            
            */
            

            return $calculadora;
          
    }

    public function getGetNomeProdutoAttribute(): string
    {

		    $nomeproduto=$this->produto->nome . " - ".$this->produto->tipounidade;

			return $nomeproduto;
    }

    public function getNomeVendedorAttribute(): string
    {

		    $nomevendedor=$this->vendedor->user->name;

			return $nomevendedor;
    }

    public function getNomeEmpresaAttribute(): string
    {

		    $nomeempresa=$this->empresa->nome;

			return $nomeempresa;
    }

     
    public function getValorFunruralAttribute(): string
    {

		    $valor=($this->vendedor->funrural->valor * $this->valorunitario)/100;

			return $valor;
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendedor()
    {
        return $this->belongsTo('App\Vendedores', 'vendedores_id');
    }

      public function produto()
    {
        return $this->belongsTo('App\Produtos', 'produtos_id');
    }



    public function empresa()
    {
        return $this->belongsTo('App\Empresas', 'empresas_id');
    }

     public function calculadora()
    {
        return $this->belongsTo('App\Calculadora', 'id','ofertas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fechamentos()
    {
        return $this->hasMany('App\Fechamento', null, 'idoferta');
    }
}
