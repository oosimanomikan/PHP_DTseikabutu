<?php 
/*
* ファイルパス(Mac): /Applications/MAMP/htdocs/DT/counter/counter.php
* ファイル名: counter.php
* アクセスURL(Mac): http://localhost:8888/DT/counter/counter.php
*
* 今回の学習内容
* ・全体の流れ（ファイルの存在確認→値の取得→インクリメントしてからファイルに書き込み）
* ・file_put_contents, file_get_contents
*
* // 今までの書き方
* $fp = fopen("count.txt", "r");
* $res = fgets($fp);
*
* // file_get_contents: ファイル読み込み専用の関数。fopen/fgets/fcloseの合わせ技。
* $res = file_get_contents("count.txt");
*
* // 改行も関係なく読み込んでくれる
* $data = file_get_contents("hoge.txt");
* var_dump($data);
* exit;
*
* fwrite($fp, $data);
* file_put_contents("ファイル名", "書き込みデータ");
*/

// ファイルがなければ、count.txtを作って0を入れてください、という処理
// is_file : 指定したファイルが通常ファイルか調べる
// file_put_contents : ファイル書き込み関数。fopen/fwrite/fcloseの合わせ技。指定したファイルが存在しない場合は作成して書き込む
// ※LOCK_EXのみ可　file_put_contents('count.txt', 0);
$num = intval(file_get_contents('count.txt')); // intval : 変数($num)の整数としての値を返す。
// 文字の場合は0になる
// $font = intval('font');
// var_dump($font);
// exit();
// '0' => 0

$num ++;
file_put_contents('count.txt', $num);
// 二回目はファイルの中身を確認してから進める
echo 'count:' . $num;
