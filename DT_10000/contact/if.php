<?php
/*
*ファイルパス(Mac): /Applications/MAMP/htdocs/DT/contact/if.php
*ファイル名: if.php
*アクセスURL(Mac): http://localhost/8080/DT/contact/if.php
*アクセスURL(Mac): http://localhost/8888/DT/contact/if.php
*アクセスURL(Mac): http://localhost/8000/DT/contact/if.php
*下記の設定をした後だと、localhostに入ることができる
*http://condeforfun.jp/how-to-install-mamp-windows-and-mac/#i-4
*/
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>PHPスクール1日目〜if.php</title>
</head>

<body>
    <?php
    //まずは表示してみよう
    //「echo」は、PHPが用意してくれている「機能」です（厳密には関数、組み込み関数）

    echo '斎藤　友彦';
    echo '<br>';
    echo 'サイトウ　トモヒコ';
    echo '<br>';

    // //exit;

    $x = '10';
    // $x(ダラー・エックス)という箱(変数)に、文字列(型)の10を入れる。

    // // ------- 用語ではなく、何をしているかについて注目！！ -------
    // // echo '斎藤　友彦';の「'斎藤　友彦'」をデータとして箱に入れておくことが出来ます。

    // // ------- 変数 -------
    // // 重要：$nameのようなデータの入れ物を変数という
    $name = '斎藤　友彦';
    // // 変数に値（データ）を格納することを代入という
    // // 変数に最初に値を代入することを「初期化」という
    echo $name;
    // // exit;
    // // 変数の値を画面に表示する処理
    // // 変数の名前を指定して、変数の値を取り出すことを「参照する、アクセスする」といいます

    // // 重要：参照できるのは、あらかじめ用意された変数のみ。
    // // echo $message;
    // // 指定された変数が存在しない場合は「Undefined variable」というメッセージがでます

    // // 重要：変数に再代入することもできる
    // $name = 'Pスク　太郎';
    // echo $name;
    // // exit;

    // // ------- 定数 -------
    // // 途中で中身を変更できない入れ物を「定数」という
    // // 何らかの意味を持つ値に名前をつける仕組みとしても使われる(function.phpにて再度説明)
    const CONST_NAME = '斎藤　友彦（定数）';
    // // 下記のような書き方もある
    // // define('CONST_NAME', '斎藤　友彦（定数）');
    echo CONST_NAME;
    // // 定まったデータなので、再代入で値を変更できない
    // // CONST_NAME = 'Pスク　太郎';

    // // ------- データ型 -------
    // // データの種類の事をデータ型という

    // //・論理型 bool, boolean(trueまたはfalseのみ。)
    // // true(正しい)かfalse(間違い)のいずれかの状態のみを持つ
    $test_bool = true;
    // var_dump($test_bool);
    // exit;

    // // ・整数型 int, integer(-1, 0, 1などの整数。)
    // // 整数型は、[...-2, -1, 0, 1, 2...]のような整数を表現する
    $test_int = 10;
    // var_dump($test_int);
    // exit;

    // //・浮動小数点型 float, double(3.14のような少数点数。)
    // // 浮動小数点型は、0.03や12.58のような少数点数を表現する
    $test_float = 3.14;
    // var_dump($test_float);
    // exit;

    // //・文字列型 string(クォートで囲まれた文字列。)
    // // シングルクォートまたはダブルクォートで囲まれた0文字以上のの文字列を表現する
    $test_string = '文字列';
    // var_dump($test_string);
    // exit;
    $test_string_alphabet = 'abc';
    // var_dump($test_string_alphabet);
    // exit;
    // UTF-8は1文字を、英数は1バイトで表現、日本語は3バイトで表現する

    // ------- データの比較をしてみよう！ -------
    /*
    * コメントアウトスタート
    * コメントアウト終わり
    */

    // [比較演算子]
    // == 大体同じ（変数の型不一致）： 穏やかな比較
    // === ちゃんと（変数の型も）同じ：厳密な比較
    echo '<br>';

    // if文 if（条件）{条件に合致した場合に行う処理}else{合致しない場合の処理}
    $id = 0;
    if ($id === '') {
        echo 'empty';
    } else {
        echo 'not empty';
    }
    echo '<br>';
    // not empty

    if ($x === 10) {
        echo '10';
    } else {
        echo 'not 10';
    }
    echo '<bt><br>';

    // 変数名はわかりやすく！
    $my_score = 70; // 数字
    // $my_score = '70'; //文字
    if ($my_score >= 80) {
        echo 'がんばりましたね';
    } elseif ($my_score >= 60) {
        echo 'もう一歩です';
    } elseif ($my_score >= 40) {
        echo '頑張りましょう';
    } else {
        echo 'ダメダメです';
    }
    echo '<br>';

    $a = 10;
    $c = 7;

    // 論理演算子
    // &&(アンサパンド)→両方とも（AND条件、かつ）
    // ||(バーティカルバー/ライン、縦線)　→片方満たせばOK（OR条件、もしくは）
    if ($a === 10 && $c === 8) {
        echo 'OK';
    } else {
        echo 'NG';
    }
    echo '<br>';

    // !==(!=) 否定（=・・・ではない)
    // $a = '0'
    if (empty($a) === true) {
        // https://www.php.net/manual/ja/types.comparisons.php
        echo '空(カラ)です';
    }
    echo '<br>';

    if ($a !== '') {
        echo '値が入っています。';
    } else {
        echo '空白です';
    }

    // 補足
    // $x = 1;
    // $y = 10;
    // $x = &$y;
    // $y = 12;
    // echo $x;

    ?>
</body>

</html>
