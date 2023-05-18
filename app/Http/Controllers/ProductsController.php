<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Companies;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $keyword = "";
        $manufacturer = "";

        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        if($request->input('manufacturer')){
            $manufacturer = $request->input('manufacturer');
        }

        $query = new Products();
        $products = $query->searchArticle($keyword, $manufacturer);

        $model = new Companies();
        $companies = $model->getList();

        return view('list', compact('products', 'companies', ['keyword', 'manufacturer']));
    }

    public function delete($id)
    {
        // テーブルから指定のIDのレコード1件を取得
        $product = Products::find($id);
        // レコードを削除
        $product->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('search');
    }

    public function detail($id)
    {
        $product = Products::with('companies')->find($id);

        return view('detail', ['product' => $product]);
    }
}
