<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companies;

class CompaniesController extends Controller
{
    public function showList() {
        // インスタンス生成
        $model = new Companies();
        $companies = $model->getList();

        return view('list', ['companies' => $companies]);
    }
}
