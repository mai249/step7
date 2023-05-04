<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
