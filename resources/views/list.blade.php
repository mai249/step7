@extends('layouts.app')

@section('title', '商品情報一覧画面')

@section('content')
    <div class="main__list">
        <div class="search__form">
            <h3 class="title">商品検索</h3>
            <form class="form">
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
                    <label class="search_title, search__diff__box">価格
                        <div class="search__diff" name="price">
                            <input type="text" id="p_low" name="p_low" value="{{ $p_low }}" placeholder="下限">
                            <p>～</p>
                            <input type="text" id="p_high" name="p_high" value="{{ $p_high }}" placeholder="上限">
                        </div>
                    </label>

                    <label class="search_title, search__diff__box">在庫数
                        <div class="search__diff" name="stock">
                            <input type="text" id="s_low" name="s_low" value="{{ $s_low }}" placeholder="下限">
                            <p>～</p>
                            <input type="text" id="s_high" name="s_high" value="{{ $s_high }}" placeholder="上限">
                        </div>
                    </label>
                </div>
                <div class="submit__courner">
                    <input class="button" type="submit" value="検索" id="search__btn">
                    <a href="{{ route('search') }}" id="reset__btn">検索条件リセット</a> 
                </div>
                <div class="registration">
                    <a href="{{ route('regist') }}" class="registration__btn">新規登録</a>
                </div>
                <table class="sort__table" id="sort__form__box">
                    <tr>
                        <th><button value="id" class="sort__button asc">id</button></th>
                        <th><button value="product_name" class="sort__button">商品名</button></th>
                        <th><button value="price" class="sort__button">価格順</button></th>
                        <th><button value="stock" class="sort__button">在庫順</button></th>
                        <th><button value="company_id" class="sort__button">メーカー名順</button></th>
                    </tr>
                </table>
            </form>
        </div>


        <div id="products__box">
        <div id="products__async">
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
                                <input type="hidden" value="{{ $product->product_name }}" name="hide_name{{ $product->id }}" class="hide_name{{ $product->id }}">
                                <button type="button" value="{{ $product->id }}" class="delete__button">削除</button>
                            @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div> <!-- #products__async -->
        </div>
    </div>
                    
@endsection