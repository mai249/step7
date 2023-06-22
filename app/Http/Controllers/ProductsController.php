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
        $p_low = "";
        $p_high = "";
        $s_low = "";
        $s_high = "";
        $order = 'id';
        $sort = 'asc';

        if(isset($_POST['keyword']) && $_POST['keyword'] !== ''){
            $keyword = $_POST['keyword'];
        }
        if(isset($_POST['manufacturer']) && $_POST['manufacturer'] !== ''){
            $manufacturer = $_POST['manufacturer'];
        }
        if(isset($_POST['p_low']) && $_POST['p_low'] !== ''){
            $p_low = $_POST['p_low'];
        }
        if(isset($_POST['p_high']) && $_POST['p_high'] !== ''){
            $p_high = $_POST['p_high'];
        }
        if(isset($_POST['s_low']) && $_POST['s_low'] !== ''){
            $s_low = $_POST['s_low'];
        }
        if(isset($_POST['s_high']) && $_POST['s_high'] !== ''){
            $s_high = $_POST['s_high'];
        }
        if(isset($_POST['order']) && $_POST['order'] !== ''){
            $order = $_POST['order'];
        }
        if(isset($_POST['sort']) && $_POST['sort'] !== ''){
            $sort = $_POST['sort'];
        }

        $query = new Products();
        $products = $query->searchArticle($keyword, $manufacturer, $p_low, $p_high, $s_low, $s_high, $order, $sort);

        $model = new Companies();
        $companies = $model->getList();

        return view('list', compact('products', 'companies', ['keyword', 'manufacturer', 'p_low', 'p_high', 's_low', 's_high', 'order', 'sort']));
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
