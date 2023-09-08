<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'submitted_by',
        'type',
        'date',
        'description',
        'amount',
        'status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }
}
