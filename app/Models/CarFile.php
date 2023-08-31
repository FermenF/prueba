<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'file',
        'card_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
