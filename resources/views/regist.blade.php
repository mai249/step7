@extends('layouts.app')

@section('title', '商品情報登録画面')

@section('content')
    <div class="main__list">
        <div class="regist__form">
            @if(session('result'))
            <div class="result">
                <p>{{session('result')}}を新しく登録しました。
            </div>
            @endif

            <h1>商品登録</h1>
            <form action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="商品名" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
                        <p class="validation">{{ $errors->first('product_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="company_id">メーカー</label>
                    <select type="text" class="form-control" id="company_id" name="company_id" value="{{ old('company_id') }}">
                        <option value="">-</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" >{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('company_id'))
                        <p class="validation">{{ $errors->first('company_id') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="価格" value="{{ old('price') }}">
                    @if($errors->has('price'))
                        <p class="validation">{{ $errors->first('price') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="在庫数" value="{{ old('stock') }}">
                    @if($errors->has('stock'))
                        <p class="validation">{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="コメント">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                        <p class="validation">{{ $errors->first('comment') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="img_path">商品画像</label>
                    <input type="file" class="form-control" id="img_path" name="img_path" value="{{ old('img_path') }}">
                </div>

                <div class="submit__courner">
                    <button type="submit" class="button btn-default">登録</button>
                    <a href="{{ route('search') }}">戻る</a> 
                </div>
            </form>
        </div>
    </div>
@endsection