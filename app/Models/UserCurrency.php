<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCurrency extends Model
{
    use HasFactory;

    protected $table = 'user_currency';

    protected $fillable = [
        'id_user',
        'id_currency_symbol'
    ];
}
