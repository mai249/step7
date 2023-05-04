<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showList() {
        // インスタンス生成
        $model = new Sales();
        $sales = $model->getList();

        return view('list', ['sales' => $sales]);
    }
}
