@extends('layouts.app')

@section('title', '商品情報一覧画面')

@section('content')
    <div class="main__list">
        <div class="search__form">
            <h3 class="title">商品検索</h3>
            <form action="{{ route('search') }}" method="GET">
                <div class="form__courner">
                    <label for="keyword" class="search_title">商品名</label>
                    <input type="text" id="keyword" name="keyword" value="{{ $keyword }}">
                    <label for="manufacturer" class="search_title">メーカー名</label>
                    <select id="manufacturer" name="manufacturer">
                        <option value="">-</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" >{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="submit__courner">
                    <input class="button" type="submit" value="検索">
                    <a href="{{ route('search') }}">検索条件リセット</a> 
                </div>
                <div class="registration">
                    <a href="{{ route('regist') }}" class="registration__btn">新規登録</a>
                </div>
            </form>
        </div>


        @foreach ($products as $product)
            <div class="box__list">
                <p class="id">ID：{{ $product->id }}</p>
                <h4>商品名：{{ $product->product_name }}</h4>
                <div class="list__container">
                    <div class="sectiong__image">
                        @if($product->img_path)
                            <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{$product->product_name }}">
                        @else
                            <img src="{{ asset('storage/noimage.png') }}" alt="noimage">
                        @endif
                    </div>
                    <div class="section__text">
                        <table>
                            <tbody>
                                <tr>
                                    <th>価格</th><td>{{ $product->price }}円</td>
                                </tr>
                                <tr>
                                    <th>在庫数</th><td>{{ $product->stock}}</td>
                                </tr>
                                <tr>
                                    <th>メーカー名</th><td>{{ $product->companies->company_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="area__button">
                            <form action="{{ route('detail', ['id'=>$product->id]) }}" method="POST" name="detail{{ $product->id }}">
                            @csrf
                                <button type="submit" value="{{ $product->id }}">詳細表示</button>
                            @csrf
                            </form>

                            <form action="{{ route('delete', ['id'=>$product->id]) }}" method="POST" name="delete{{ $product->id }}">
                            @csrf
                                <button type="button" value="{{ $product->product_name }}" onClick="confirmDelete(this.value,{{ $product->id }})">削除</button>
                            @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
                    
@endsection