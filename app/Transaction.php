<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    protected $fillable = [
        'user_id',
        'account_id',
        'type',
        'status',
        'operation',
        'value',
        'prevision_date',
        'realization_date'
    ];
    
    protected $dates = [
        'prevision_date',
        'realization_date'
    ];
}
