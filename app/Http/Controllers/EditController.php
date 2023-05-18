<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Products;
use App\Models\Companies;

class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editForm(Request $request) {

        $id = "";

        $id = $request->input('id');
        $product = Products::with('companies')->find($id);

        $model = new Companies();
        $companies = $model->getList();

        return view('edit', ['product' => $product, 'companies' => $companies]);
    }

    public function update(EditRequest $request) {

        $request_name = $request->product_name; 
        $request_img = $request->file('img_path');
        $request_id = $request->id;
        $file_name = "";

        dump($request_id);

        if($request_img){
            // アップロードされたファイル名を取得
            $file_name = $request_img->getClientOriginalName();

            // 取得したファイル名で保存
            $img_path = $request->file('img_path')->storeAs('public/', $file_name);
        }else{
            $file_name = Products::find($request_id)->img_path;
        }

        // トランザクション開始
        DB::beginTransaction();
    
        try {
            // 登録処理呼び出し
            $model = new Products();
            $model->editArticle($request, $file_name);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    
        // 処理が完了したらeditにリダイレクト
        return redirect()->route('edit', ['id' => $request_id])->with(['result' => $request_name]);
    }
}
