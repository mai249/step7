<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required | max:255',
            'company_id' => 'required',
            'price' => 'required | max:10000 | integer',
            'stock' => 'required | max:100000 | integer',
            'comment' => 'max:10000',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => '商品名は必須項目です。',
            'product_name.max' => '商品名は:max字以内で入力してください。',
            'company_id.required' => 'メーカーは必須項目です。',
            'price.required' => '価格は必須項目です。',
            'price.max' => '価格は一本辺りの価格（:max字以内）で入力してください。',
            'price.integer' => '価格は半角数字で入力してください。',
            'stock.required' => '在庫数は必須項目です。',
            'stock.max' => '在庫数は:max個以内で入力してください。',
            'stock.integer' => '在庫数は半角数字で入力してください。',
            'comment.max' => 'コメントは:max字以内で入力してください。',
        ];
    }
}
