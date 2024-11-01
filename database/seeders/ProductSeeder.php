<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'name' => 'Samsung S23',
                'type' => 'Electronic',
                'description' => 'Smartphone by samsung',
                'sell_price' => 11500000.00,
                'buy_price' => 16500000.00,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell XPS',
                'type' => 'Electronic',
                'description' => 'Thin laptop',
                'sell_price' => 20000000.00,
                'buy_price' => 35000000.00,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ipad',
                'type' => 'Electronic',
                'description' => 'Ipad Wifi Only',
                'sell_price' => 3000000.00,
                'buy_price' => 9000000.00,
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
