<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'balances';
    protected $fillable = [
        'AcountID',
        'Date',
        'OpeningBalance',
        'ClosingBalance',
        'Status',
    ];
}
