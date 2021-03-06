<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'ticker', 'name', 'inicial_history','last_history_update',
    ];

    public function history()
    {
        return $this->hasMany(HistoryStock::class);
    }
}
