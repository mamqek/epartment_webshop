<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skus')->insert([
            [
                'item_id' => 1,
                'number' => '123456',
                'price_from' => 1999.99,
                'price_your' => 999.99,
                'color' => 'black',
                'size' => 'normal',
                'paddles' => 'normal',
            ],
            [
                'item_id' => 1,
                'number' => '123457',
                'price_from' => 1999.99,
                'price_your' => 999.99,
                'color' => 'white',
                'size' => 'normal',
                'paddles' => 'normal',
            ],
            [
                'item_id' => 1,
                'number' => '223456',
                'price_from' => 3599.99,
                'price_your' => 1799.99,
                'color' => 'black',
                'size' => 'large',
                'paddles' => 'normal',
            ],
            [
                'item_id' => 1,
                'number' => '223457',
                'price_from' => 3599.99,
                'price_your' => 1799.99,
                'color' => 'white',
                'size' => 'large',
                'paddles' => 'normal',
            ],
            [
                'item_id' => 1,
                'number' => '133456',
                'price_from' => 2298.99,
                'price_your' => 1298.99,
                'color' => 'black',
                'size' => 'normal',
                'paddles' => 'extended',
            ],
            [
                'item_id' => 1,
                'number' => '133457',
                'price_from' => 2298.99,
                'price_your' => 1298.99,
                'color' => 'white',
                'size' => 'normal',
                'paddles' => 'extended',
            ],
            [
                'item_id' => 1,
                'number' => '233456',
                'price_from' => 3898.99,
                'price_your' => 2098.99,
                'color' => 'black',
                'size' => 'large',
                'paddles' => 'extended',
            ],
            [
                'item_id' => 1,
                'number' => '233457',
                'price_from' => 3898.99,
                'price_your' => 2098.99,
                'color' => 'white',
                'size' => 'large',
                'paddles' => 'extended',
            ],

        ]);
    }
}
