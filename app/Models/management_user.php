<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class management_user extends Model
{
    use HasFactory;
    protected $table ='management_user';
    protected $fillable = [
        'id',
        'employee_id',
        'email',
        'password',
        'lastLogin',
        'status',
        'roll',
    ];
}