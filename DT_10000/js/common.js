// 解決方法のURL
https://b.0218.jp/202111152315.html
$(function(){
    $('#address_search').click(function(){
      var zip1 = $('#zip1').val();
      var zip2 = $('#zip2').val();
  
      var entry_url = $('#entry_url').val();
  
      if(zip1.match(/[0-9]{3}/) === null || zip2.match(/[0-9]{4}/) === null)
      {
        alert('正確な郵便番号を入力してください');
        return false; //ページ遷移をしない
      }else{
        $.ajax({
          type : "get",
          url : entry_url + "/postcode_search.php?zip1=" + escape(zip1) + "&zip2=" + escape(zip2),
        }).then(
          function(data)
          {
            if(data == 'no' || data == '')
            {
              alert('該当する郵便番号がありません');
            }else{
              $('#address').val(data);
            }
          },
          function(data)
          {
            alert("読み込みに失敗しました。")
          },
        );
      }
    });
  });