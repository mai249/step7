<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Sales extends Model
{
    use HasFactory;

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }

    public function getList() {
        // salesテーブルからデータを取得
        $sales = DB::table('sales')->get();

        return $sales;
    }

    public function purchaseArticle($product_id) {
        // 登録処理
        DB::table('sales')->insert([
            'product_id' => $product_id,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }

}
