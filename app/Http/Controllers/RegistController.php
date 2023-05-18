<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Requests\RegistRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Companies;

class RegistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegistForm() {
        $model = new Companies();
        $companies = $model->getList();

        return view('regist', ['companies' => $companies]);
    }

    public function registSubmit(RegistRequest $request) {

        $request_name = $request->product_name; 
        $request_img = $request->file('img_path');
        $file_name = "";

        if($request_img){
            // アップロードされたファイル名を取得
            $file_name = $request_img->getClientOriginalName();

            // 取得したファイル名で保存
            $img_path = $request->file('img_path')->storeAs('public/', $file_name);
        }

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Products();
            $model->registArticle($request, $file_name);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらregistにリダイレクト

        return redirect()->route('regist')->with(['result' => $request_name]);
    }
}
