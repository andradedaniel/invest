<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarteiraAcao extends Model
{
    protected $table = 'carteira_acoes';

    protected $fillable = [
        'user_id','tipo','acao_id','date','qtd','preco','taxa','valor_operacao','lucro','qtd_atual','pm_atual','qtd_anterior','pm_anterior',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
