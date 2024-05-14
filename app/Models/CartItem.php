<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_item';

    protected $fillable = ['cart_id', 'sku_id', 'item_id', 'quantity', 'extra_option'];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function sku()
    {
        return $this->belongsTo('App\Models\Sku');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
