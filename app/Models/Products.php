<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Products extends Model
{
    use HasFactory;

    public function sales() {
        return $this->hasMany('App\Models\Sales');
    }

    public function companies() {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }

    public function registArticle($data, $img) {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $img,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }

    public function editArticle($data, $img) {
        // 登録処理
        DB::table('products')->where('id', $data->id)->update([
            'product_name' => $data->product_name,
            'company_id' => $data->company_id,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $img,
            'updated_at' => new DateTime(),
        ]);
    }

    public static function searchArticle($keyword, $manufacturer) {
        // 検索処理

        $query = Products::query();
        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        if(!empty($manufacturer)) {
            $query->where('company_id', 'LIKE', "{$manufacturer}");
        }
        $search = $query->with('companies')->get(); 

        return $search;

    }
}
