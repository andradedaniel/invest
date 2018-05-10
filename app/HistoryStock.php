<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryStock extends Model
{
    protected $fillable = [
        'stock_id', 'date', 'closed','min','max','var','var_percent',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
