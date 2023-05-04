<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
