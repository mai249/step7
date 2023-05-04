
window.onload = function(){
    // メーカー名選択保持
    var url = new URL(window.location.href);
    // URLSearchParamsオブジェクトを取得
    var params = url.searchParams.get('manufacturer');

    if( params !== null && params !== '') {
        var manufacturer = document.getElementById('manufacturer');
        manufacturer.options[params].selected = true;
    }

    // 新規登録成功時
    const MY_HEADERS = new Headers();
    var result = MY_HEADERS.get('result');
    if(result !== null){
        alert(result + "を新しく登録しました。")
    }
}

// 削除ボタン押下イベント
function confirmDelete(value,fname){
    var result = window.confirm(value + "のデータを、本当に消してよろしいですか？");
    const formname = "delete" + fname;
    if(result === true){
        document.forms[formname].submit();
    }
}