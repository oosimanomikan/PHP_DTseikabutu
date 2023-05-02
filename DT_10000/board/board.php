<?php
/*
* ファイルパス(Mac): /Applications/MAMP/htdocs/DT/board/board.php
* ファイル名: board.php
* アクセスURL(Mac): http://localhost:8888/DT/board/board.php
*
* 今回の学習内容
* ・全体の流れ(ファイル読み込み→投稿があったか確認→投稿があれば入力チェック→ファイルに書き込み)
* ・while構文
* ・外部データの取り扱い、ファイル操作
* ・インクリメント
*/

// 1: データの取得を行う
$data = '';

// $fpにはfopenの戻り値（ファイルハンドル）が入っている
// ファイルポインタを開く、ファイルと読み込みか書き込みか
// 引数（「◯◯して欲しい」という依頼）はファイルモード
$fp = fopen('data.txt', 'r');
// 一行（1行）ずつファイルを読み込む。
// 新規でdata.txtと、data2.txtを作成してください。中身は空白でOK
$flg = true;
$count = 0;
while ($flg === true) {
    // fgets():1行取得する、whileで回して全行取得
    $res = fgets($fp);
    // var_dump($res); // テキストを1行ずつ表示
    // echo '<br>';

    if ($res === false) {     // ループしきるとfalse
        $flg = false;
    }
    // ↓$data = $data(今までの書き込み全て) + $res
    //  $a . $b 結合

    // 1回目: $data = $res;
    // 2回目: $data = $res . $res;
    // 3回目: $data = $res . $res . $res;
    // 4回目: $data = $res . $res . $res . $res;

    $data = $res;   // 連結させないとhtmlのechoで何も表示されていないように見える。※正確には最後の行のnullが表示されている。
    // echo '<br>';

    $count++;
    if ($count % 2 === 0) {      // 2行分の出力ごとに<br>を行末につける。
        $data .= '<br>';
    }
    // var_dump($data);  //テキストが1個ずつ連結されていく
    // echo '<br>';
}

// しおりをしまう
fclose($fp);
// よりスマートな書き方はこれ↓
// while($res = fgets($fp)){
//      $data .= $res . "<br>";
// }
