<?php
/*
* ファイルパス(Mac):/Applications/MAMP/htdocs/DT/function/function.php
* ファイル名:function.php
* アクセスURL(Mac):http://localhost:8888/DT/function/function.php
*
* 今回の学習内容
* ・関数（何度も行うめんどくさい処理はこれで一括で行う、リモコンのスイッチみたいなもの）
* メリット
* ・同じような処理を一括で行うためのソースコードが読みやすくなる
* ・修正があった時に関数内部の修正を行えば全ての処理に反映させることができる
* ・可読性、保守性の向上
* ・引数、戻り値、スコープ
*/

// const TAX = 1.08;
// $arr = [
// 'saito',
// 'tomohiko',
// 'chiba',
// 'PHP'
// ];
// echo(), var_dump() count()も関数です！
// $num = count($arr);
// var_dump($num);

// 定数を定義（作成）する関数もあります！

// define（定義名、設定する値）：定数の定義
define('TAX', 1.08); //定数
// Q.プログラムは上から下まで走るから、関数の定義は、上でやらないとダメじゃないの？
// A.phpはコンパイルを行う。一旦上から下まで全部読み込んで、その後で関数を「呼び出し」しているのでエラーにならない。

// 利点
// 1: 同じ処理を使いまわせる
// 2: 書き間違いの可能性が減らせる
// 3: 修正の対応が簡単

say_hello('matsumoto');
say_hello('tanaka');
say_hello('watanabe');
say_hello('katou');
// say_hello();

say_hello2();
say_hello2('kazuma');
say_hello3('matsumoto', 34);

// グローバル変数、ローカル変数の違いのために用意
$price = 1000;
echo $price . '<br>';

// 仮引数が入口、戻り値が出口
$price2 = calc($price);
echo $price2;
echo '<br>';
// echo calc($price) . '<br>';
// echo $price2;
// $price = $price * 2;

echo $price . '<br>';

// 関数の定義方法
// function 関数名（引数）{
// 処理内容
// }
// 関数の外の$priceは変わらないことに注意
// 関数の中と外では、別の変数。関数の外：グローバル変数、関数の中：ローカル変数。

function say_hello($name) //say_hello('matsumoto');
{
    echo 'hi' . $name . '<br>'; //hi matsumoto
    echo 'your name is' . $name . '<br>'; //your name is matsumoto
    echo '<br>';
}

function say_hello2($name = 'hoge')
{
    // 初期値ではhoge。変数あればその値を使う
    echo 'hi' . $name . '<br>';
    echo 'your name is' . $name . '<br>';
    echo '<br>';
}

function say_hello3($name, $age)
{
    echo $name . 'is' . $age . 'years old' . '<br>';
    echo '<br>';
}

// 引数はなくても良いパターンもある
// function say_hoge(){
//  echo 'hoge';
// }
// say_hoge();

/*
* 参考問題　引数2つ　$name . $fine_flg
* 晴れ(true)なら $name さん良い天気ですね。
* 雨(false)なら $name さん今日は雨ですね。
*/
function say_weather($fine_flg)
{
}

// function say_weather($name, $fine_flg){
//  if($fine_flg === true){
//    echo $name . 'さん良い天気ですね';
//  }else{
//  echo $name . 'さん今日は雨ですね';
//  }
// }
// say_weather('かごやま', true)

function calc($price)
{
    $price = 1.2 * $price;
    $price2 = $price * TAX;
    return $price2;
    // 戻る変数がある場合はreturnを使う
}
