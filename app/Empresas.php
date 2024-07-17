<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $cidades_id
 * @property string $nome
 * @property string $email
 * @property string $logradouro
 * @property string $numero
 * @property string $telefone
 * @property string $celular
 * @property Cidade $cidade
 * @property User[] $users
 */
class Empresas extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id','cidades_id', 'nome', 'email', 'logradouro', 'numero', 'telefone', 'celular'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cidade()
    {
        return $this->belongsTo('App\Cidade', 'cidades_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'empresas_id');
    }
}
