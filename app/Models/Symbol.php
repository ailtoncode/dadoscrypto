<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Symbol extends Model
{
    use HasFactory;

    protected $table = "currency_symbols";

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'id_broker'
    ];

    // public function broker()
    // {
    //     return $this->belongsTo(Broker::class);
    // }
}
