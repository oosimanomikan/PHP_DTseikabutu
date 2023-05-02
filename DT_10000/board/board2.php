<?php 
/*
* ファイルパス(Mac):/Applications/MAMP/htdocs/DT/board/board2.php
* ファイル名: board2.php
* アクセスURL(Mac): http://localhost:8888/DT/board/board2.php
*
* 今回の学習内容
* ・全体の流れ（投稿があったか確認→投稿があれば入力チェックして書き込み→配列への格納→多次元連想配列の表示）
* ・配列
* ・while, foreach
*/

var_dump($_POST);

// 先に書き込みを行う
if(isset($_POST['send']) === true){

    // var_dump($_POST);
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if($name !== '' && $comment !== ''){

        $fp = fopen('data2.txt', 'a');
        if(flock($fp, LOCK_EX) === true){
            fwrite($fp, $name . "¥t" . $commtnt . "¥n");
            flock($fp, LOCK_UN);
        }
    }else{
        echo '名前もしくは、コメントが記入されていません';
    }
}

// ファイルに書き込まれたデータを読み込む
$fp = fopen('data2.txt', 'r');
$lineArray3 = [];
while ($res = fgets($fp)){ // trueの意。読み込み終わるとfalse
    // 一行の書き込みを配列に分割
    $lineArray = explode("¥t", $res);  // "¥t"はtab。tabごとに区切っている
    // $lineArray = ['鹿児山', '貴史'];
    // var_dump($lineArray);
    // 配列の個々の部分にアクセス  echo $lineArray[0];
    // 配列を連想配列にする。ラベル付き
    if (isset($lineArray[0]) && isset($lineArray[1])){
        $lineArray2 = [
            'name' => $lineArray[0],
            'comment' => $lineArray[1]
        ];
    }else{
        $lineArray2 = null;
    }
    // var_dump($lineArray2); //lineArray2は1個ずつの連想配列
    // 連想配列を多次元配列に入れる（エクセルのイメージを持つとわかりやすい）
    // 個々の連想配列$lineArray2を1つの多次元配列にまとめる
    // $lineArray3[] = $lineArray2;
}
// var_dump($lineArray3);
// echo '<br><br>';
// fclose($fp);
?>
