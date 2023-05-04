<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'id' => 1,
                'company_name' => 'サントリー食品インターナショナル株式会社',
                'street_address' => '東京都港区芝浦三丁目1番1号',
                'representative_name' => '小野　真紀子',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'id' => 2,
                'company_name' => 'アサヒ飲料株式会社',
                'street_address' => '東京都墨田区吾妻橋一丁目23番1号',
                'representative_name' => '米女　太一',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
    }
}
