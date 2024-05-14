<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{

    public function show(Item $item)
    {   
        $item->load('skus');
        return $item;
    }

}
