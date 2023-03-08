<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    use HasFactory;

    protected $table = 'currency_history';

    protected $fillable = [
        'data_json',
        'id_broker'
    ];
}
