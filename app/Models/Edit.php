<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Edit extends Model
{
    use HasFactory;

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
}
