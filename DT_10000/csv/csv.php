<?php
/*
ファイルパス（Mac）：/Applications/MAMP/htdocs/DT/csv/csv.php
アクセスURL（Mac)：http://localhost:8888/DT/csv/csv.php
*/

//オブジェクトからインスタンス生成
//SplFileObject:ファイルを読み込む定義済みクラス：https://www.php.net/manual/ja/splfileobject.construct.php
//SplFileObject::READ_CSV：定義済みの定数。CSV列として行を読み込む

$file = new SplFileObject('read.csv'); //","で勝手に区切ってくれる
$file->setFlags(SplFileObject::READ_CSV); //setFlgs : SplFileObject内の関数。フラグをセットする。

$i = 1;
$flg = true;
foreach ($file as $line) { //line[0]:先頭の番号、line[1]:日付、line[2]:末尾の番号
    // var_dump($file); //objectが表示される
    // var_dump($line); //内容が表示される
    // exit;

    if ($line[0] === null) continue; //line[0]（先頭行がnullの場合、スキップして処理続行。continue省くと97行目（nullの行）でエラーが出る）
    $divDate = explode('-', $line[1]);
    //$divDate = ['2011', '12', '08'];
    //preg_match: 正規表現によるマッチング
    //trim: 文字列の先頭及び末尾にあるスペースを取り除く
    //checkdate: 「月」「日」「年」の順番
    if (
        preg_match('/^[0-9]{4}$/', trim($line[0])) === 0 ||  //preg_matchはマッチした回数を繰り返す（0回）
        checkdate($divDate[1], $divDate[2], $divDate[0]) === false ||
        preg_match('/^[0-9]$/', $line[2]) === 0
    ) { //一桁の場合、上記の通り{1}不要
        echo $i . '行目にエラーがあります<br>';
        $flg = false;
    }
    $i++;
}
if ($flg === true) {
    echo '正常に終了しました';
}

$fp = fopen("read.csv", "r");

$i = 1;
$flg = true;

while ($res = fgetcsv($fp, "1024")) {

    $divDate = explode("-", $res[1]);
    if (
        preg_match('/^[0-9]{4}$/', trim($res[0])) === 0 ||
        checkdate($divDate[1], $divDate[2], $divDate[0]) === false ||
        preg_match('/[0-9]{1}$/', $res[2]) === 0
    ) {
        echo $i . "行目にエラーがあります<br>";
        $flg = false;
    }
    $i++;
}
if ($flg === true) {
    echo "正常に終了しました";
}

/* 正規表現:http://okumocchi.jp/php/re.php

    . なんでもいい1文字を表す
    ^(キャレット)　先頭を意味する
    *(アスタリスク)　直前の文字がなし、または1つ以上連続する
    +　直前の文字が最低でも1つ以上連続する
    ?　直前の文字がなし、または1つだけ
    |　|で区切られた文字列のいずれか

    []　[]内の文字のいずれか
    [ABC]　AかBかC

    ()　グループ化する
    (ABC)+
    ABCABC

    ABかCか どれか？
    (AB|C)

    W(indows|)

    {n}　n回一致する
    {n,}　n回以上一致する
    {m,n}　m回以上、n回以下に一致する

    a-z　アルファベットaからzまで
    A-Z　アルファベットAからZまで
    0-9　数字の0から9まで
    \d　数字の0から9まで
*/
