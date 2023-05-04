@extends('layouts.app')

@section('title', '商品情報編集画面')

@section('content')
    <div class="main__list">
        <div class="edit__form">
            @if(session('result'))
            <div class="result">
                <p>{{session('result')}}を更新しました。
            </div>
            @endif

            <h1>商品編集</h1>
            <form action="{{ route('update') }}"  method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="product_name">商品情報ID</label>
                    <input type="hidden" value="{{ $product->id }}" name="id">
                    <p class="id">{{ $product->id }}</p>
                </div>

                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="商品名" value="{{ $product->product_name }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="company_id">メーカー</label>
                    <select type="text" class="form-control" id="company_id" name="company_id" value="">
                    <option value="">-</option>
                        @foreach($companies as $company)
                            @if($company->id === $product->company_id)
                                <option value="{{ $company->id }}" selected>{{ $company->company_name }}</option>
                            @else
                                <option value="{{ $company->id }}" >{{ $company->company_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if($errors->has('company_id'))
                        <p>{{ $errors->first('company_id') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="価格" value="{{ $product->price }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="在庫数" value="{{ $product->stock }}">
                    @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="コメント">@if($product->comment){{ $product->comment }}@endif</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="img_path">商品画像</label>
                    <input type="file" class="form-control" id="img_path" name="img_path">
                </div>
                
                <div class="form-group">
                    <p>登録中の画像</p>
                    @if($product->img_path)
                        <p>{{$product->img_path}}</p>
                        <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{$product->product_name }}">
                    @else
                        <p class="txt__noimage">現在登録中の画像はありません。</p>
                    @endif
                </div>

                <div class="submit__courner">
                    <button type="submit" class="button btn-default">更新</button>
                    <a href="{{ route('search') }}">戻る</a> 
                </div>
            </form>
        </div>
    </div>
@endsection