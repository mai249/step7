window.onload = function() {
    // ajax - 検索
    $('.form').on('submit', function(e) {
        e.preventDefault();
        var api_url = window.location.pathname;
        var data = {
            'keyword' : $("#keyword").val(),
            'manufacturer' : $('[name=manufacturer]').val(),
            'p_low' : $("#p_low").val(),
            'p_high' : $("#p_high").val(),
            's_low' : $("#s_low").val(),
            's_high' : $("#s_high").val(),
            'order' : '',
            'sort' : ''
        };
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
            type:'POST',
            url: api_url,
            data: data,
            dataType: 'html'
        }).done(function(data) {
            var bodyInnerHTML = data.split('<div id="products__box">');
            bodyInnerHTML = bodyInnerHTML[1].split('</div> <!-- #products__async -->');
            $('#products__async').html(bodyInnerHTML[0]);
        }).fail(function(jqXHR, textStatus, errorThrown){
            alert('error');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    }
    );

    // ajax - 検索リセット
    $('#reset__btn').on('click', function(e) {
        e.preventDefault();
        var api_url = window.location.pathname;

        $('.sort__button').removeClass('asc');
        $('.sort__button').removeClass('desc');
        $('.sort__button').eq(0).addClass('asc');

        var data = {
            'keyword' : '',
            'manufacturer' : '',
            'p_low' : '',
            'p_high' : '',
            's_low' : '',
            's_high' : '',
            'order' : '',
            'sort' : ''
        };
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
            type:'GET',
            url: api_url,
            data: data,
            dataType: 'html'
        }).done(function(data) {
            var bodyInnerHTML = data.split('<div id="products__box">');
            bodyInnerHTML = bodyInnerHTML[1].split('</div> <!-- #products__async -->');
            $('form').find(':text').val("");
            $('form').find('#manufacturer').val("");
            $('#products__async').html(bodyInnerHTML[0]);
        }).fail(function(jqXHR, textStatus, errorThrown){
            alert('error');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });

    }
    );

    // ajax - 並び変え
    $('.sort__button').on('click', function(e) {
        e.preventDefault();
        var api_url = window.location.pathname;
        var order = e.target.value;

        if($(this).hasClass('asc')){
            $('.sort__button').removeClass('asc');
            $('.sort__button').removeClass('desc');
            $(this).addClass('desc');
            sort = 'desc';
        }else if($(this).hasClass('desc')){
            $('.sort__button').removeClass('asc');
            $('.sort__button').removeClass('desc');
            $(this).addClass('asc');
            sort = 'asc';
        }else{
            $('.sort__button').removeClass('asc');
            $('.sort__button').removeClass('desc');
            $(this).addClass('asc');
            sort = 'asc';
        }


        var data = {
            'keyword' : $("#keyword").val(),
            'manufacturer' : $('[name=manufacturer]').val(),
            'p_low' : $("#p_low").val(),
            'p_high' : $("#p_high").val(),
            's_low' : $("#s_low").val(),
            's_high' : $("#s_high").val(),
            'order' : order,
            'sort' : sort
        };
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
            type:'POST',
            url: api_url,
            data: data,
            dataType: 'html'
        }).done(function(data) {
            var bodyInnerHTML = data.split('<div id="products__box">');
            bodyInnerHTML = bodyInnerHTML[1].split('</div> <!-- #products__async -->');
            $('#products__async').html(bodyInnerHTML[0]);
        }).fail(function(jqXHR, textStatus, errorThrown){
            alert('error');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    }
    );

    // ajax - 削除
    $('.delete__button').on('click', function(e) {
        e.preventDefault();
        var api_url = window.location.pathname;
        var id = e.target.value;
        var value = $(".hide_name" + id).val();
        var result = window.confirm(value + "のデータを、本当に消してよろしいですか？");
        if(result === false){
            return alert(value + "の削除がキャンセルされました。");
        };

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
            type:'POST',
            url: api_url + id,
            data: {'id':id},
            dataType: 'html'
        }).done(function(data) {
            var bodyInnerHTML = data.split('<div id="products__box">');
            bodyInnerHTML = bodyInnerHTML[1].split('</div> <!-- #products__async -->');
            $('#products__async').html(bodyInnerHTML[0]);
            alert(value + "が削除されました。")
        }).fail(function(jqXHR, textStatus, errorThrown){
            alert('error');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    }
    );

    // メーカー名選択保持
    var url = new URL(window.location.href);
    // URLSearchParamsオブジェクトを取得
    var params = url.searchParams.get('manufacturer');

    if( params !== null && params !== '') {
        var manufacturer = document.getElementById('manufacturer');
        manufacturer.options[params].selected = true;
    };

    // 新規登録成功時
    const MY_HEADERS = new Headers();
    var result = MY_HEADERS.get('result');
    if(result !== null){
        alert(result + "を新しく登録しました。")
    };
}