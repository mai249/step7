@extends('layouts.app')

@section('title', '商品情報詳細画面')

@section('content')
    <div class="main__list">
        <div class="detail__box">
            <p class="id">商品情報ID：{{ $product->id }}</p>
            <h2>商品名：{{ $product->product_name }}</h2>
            <div class="list__container">
                <div class="sectiong__image">
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{$product->product_name }}">
                </div>
                <div class="section__text">
                    <table>
                        <tbody>
                            <tr>
                                <th>メーカー</th><td>{{ $product->companies->company_name }}</td>
                            </tr>
                            <tr>
                                <th>価格</th><td>{{ $product->price }}円</td>
                            </tr>
                            <tr>
                                <th>在庫数</th><td>{{ $product->stock}}</td>
                            </tr>
                            <tr>
                                <th>コメント</th><td>{{ $product->comment }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="area__button">
                        <form action="{{ route('edit') }}" method="GET">
                        @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button type="submit" class="button btn-default edit">編集</button>
                        @csrf
                        </form>
                        <a href="{{ route('search') }}">戻る</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection