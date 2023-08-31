<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'price'
    ];

    public function files()
    {
        return $this->hasMany(CarFile::class);
    }

    public function scopeByBrand($query, $brand)
    {
        if (!empty($brand)){
            $query->where('brand', 'LIKE', '%'. $brand .'%');
        }

        return $query;
    }

    public function scopeByModel($query, $model)
    {
        if (!empty($model)){
            $query->where('model', 'LIKE', '%'. $model .'%');
        }

        return $query;
    }
}
