<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'company_id' => 1,
                'product_name' => 'お茶',
                'price' => 120,
                'stock' => 120,
                'comment' => '500ml',
                'img_path' => 'tea.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id' => 2,
                'company_id' => 2,
                'product_name' => 'サイダー',
                'price' => 180,
                'stock' => 95,
                'comment' => '500ml',
                'img_path' => 'soda.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id' => 3,
                'company_id' => 1,
                'product_name' => '天然水',
                'price' => 90,
                'stock' => 350,
                'comment' => '250ml',
                'img_path' => 'water.jpg',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
    }
}
