<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{
    use HasFactory;

    public function products() {
        return $this->hasMany(Products::class, 'id');
    }

    public function getList() {
        // companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();

        return $companies;
    }
}
