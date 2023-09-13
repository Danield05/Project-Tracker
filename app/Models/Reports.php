<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class);
    }
}
