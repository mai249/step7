<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sales;
use App\Models\Products;

class SalesController extends Controller
{

    public function showList() {
        // インスタンス生成
        $model = new Sales();
        $sales = $model->getList();

        // return view('list', ['sales' => $sales]);
        return response()->json($sales);
    }

    public function purchase(Request $request) {
        //id取得
        $product_id = $_GET['id'];

        //id該当のproductテーブルの在庫数チェック→0ならエラー処理
        $product_stock = Products::find($product_id)->stock;
        $product_name = Products::find($product_id)->product_name;
        if($product_stock <= 0){
            exit ($product_name . 'は売り切れました。');
        }
        
        //在庫数減らしてDB反映
        $product_stock -= 1;

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 購入登録（salesテーブル）
            $model = new Sales();
            $model->purchaseArticle($product_id);
            // 商品情報-在庫数反映（productテーブル）
            $model = new Products();
            $model->stockArticle($product_id, $product_stock);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return $product_name . 'の購入が完了しました。残り在庫数は' . $product_stock . 'です。';
    }
}