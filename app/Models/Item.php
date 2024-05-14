<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function skus()
    {
        return $this->hasMany('App\Models\Sku');
    }

    public function getImageAttribute($value)
    {
        return env('APP_URL') . '/' . $value;
    }
}
