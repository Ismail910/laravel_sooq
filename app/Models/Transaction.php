<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "user_transactions";

    protected $fillable = [
        'transaction_id', 
        'wallet_id', 
        'amount',
        'type'
    ];

}
