<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'username',
        'month',
        'year',
        'budget',
    ];

}
