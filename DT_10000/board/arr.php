<?php
/*
* ファイルパス(Mac): /Applications/MAMP/htdocs/DT/board/arr.php
* ファイル名: arr.php
* アクセスURL: http://localhost:8888/DT/board/arr.php
*/

$var = 1;
$var2 = '1';
$name = '齊藤';
var_dump($var);
var_dump($var2);
var_dump($name);
echo '<br>';
// 配列: arrayで定義、値はカンマで区切る
$arr = array(
    'saito',
    'tomohiko',
    'chiba',
    'PHP'
);
// 5.4以降では下記のような書き方もできます。
$arr = [
    'saito',
    'tomohiko',
    'chiba',
    'PHP'
];
var_dump($arr);
echo '<br>';
echo '<br>';
// 自動的に番号（インデックス）が振られている（ただし0から始まる）ので個別の配列は以下のようにアクセスできる
echo $arr[0];
echo '<br>';
echo '<br>';

echo $arr[1];
echo '<br>';
echo '<br>';

// 配列を追加したいときは番号で入れてあげればよい。その時の入れ方は普通の変数と一緒
$arr[4] = 'man';
echo '<br>';
echo '<br>';

// 以下のような形で値を変えることもできる
$arr[2] = 'tokyo';
var_dump($arr);
echo '<br>';
echo '<br>';

// 「正直、$arr[2]の「2」とか、何を表しているのかわかりにくいな〜」=> 連想配列を使いましょう！
// 連想配列(ラベルをつけた配列）:key => value という構成。=>（ダブルアロー）
$label_arr = array(
    'family_name' => 'saito',
    'first_name' => 'tomohiko',
    'pref' => 'chiba',
    'language' => 'PHP'
);

// 連想配列も5.4以降下記のようにかけます
$label_arr = [
    'family_name' => 'saito',
    'first_name' => 'tomohiko',
    'pref' => 'chiba',
    'language' => 'PHP'
];
var_dump($label_arr);
echo '<br>';
echo '<br>';

// 個別の値にはkeyでアクセスする
echo $label_arr['language'];
echo '<br>';
echo '<br>';

// 配列を追加したい時はkeyを添えて入れてあげる感じ
$label_arr['hobby'] = 'baseball';
var_dump($label_arr);
echo '<br>';
echo '<br>';

// 以下のような形で値を変えることもできる
$label_arr['language'] = 'Perl';
var_dump($label_arr);
echo '<br>';
echo '<br>';

// 「複数名の情報をまとめて扱いたいなぁ〜」=> 多次元配列を使いましょう！
// 多次元配列：エクセル形式のような配列。以下はイメージ
// family_name first_name preg language
// 0 saito tomohiko chiba PHP
// 1 tanaka youhei tokyo C
// 2 sato ichiro kanagawa Java

// 配列の中に、配列を入れる（カンマを忘れないように！）
// $arr = array('saito', 'tomohiko', 'chiba');
$excel_arr(
    array(
        'family_name' => 'saito',
        'first_name' => 'tomohiko',
        'pref' => 'chiba',
        'language' => 'PHP'
    ),
    array(
        'family_name' => 'tanaka',
        'first_name' => 'youhei',
        'pref' => 'tokyo',
        'language' => 'C'
    ),
    array(
        'family_name' => 'sato',
        'first_name' => 'ichiro',
        'pref' => 'kanagawa',
        'language' => 'Java'
    )
);

// 5.4以降下記の書き方が可能です。
$excel_arr = [
    [
        'family_name' => 'saito',
        'first_name' => 'tomohiko',
        'pref' => 'chiba',
        'language' => 'PHP'
    ],
    [
        'family_name' => 'tanaka',
        'first_name' => 'youhei',
        'pref' => 'tokyo',
        'language' => 'C'
    ],
    [
        'family_name' => 'sato',
        'first_name' => 'ichiro',
        'pref' => 'kanagawa',
        'language' => 'Java'
    ]
];

var_dump($excel_arr);
echo '<br>';
echo '<br>';

// 個別の配列は番号（インデックス）とkeyでアクセスできる。
var_dump($excel_arr[1]);
echo '<br>';
echo '<br>';
echo $excel_arr[0]['language'];
echo '<br>';
echo '<br>';

// 配列へのアクセスの仕方
echo $excel_arr[1]['pref'];
echo '<br>';
echo '<br>';
$excel_arr[1]['pref'] = 'osaka';
var_dump($excel_arr);
echo '<br>';
echo '<br>';

// 値を追加したい時は番号を入れてもよいが、array_pushや$arr2[] = $arrなどを使うと自動的に入る
// まず、番号を使う場合
$excel_arr[3] = array(
    'family_name' => 'suzuki',
    'first_name' => 'jiro',
    'pref' => 'saitama',
    'language' => 'Perl'
);
var_dump($excel_arr);
echo '<br><br>';

// array_pushを使う場合
$arr = array(
    'family_name' => 'suzuki',
    'family_name' => 'jiro',
    'pref' => 'saitama',
    'language' => 'Perl'
);
array_push($excel_arr, $arr);
// $excel_arr[] = $arrも全く同じ意味
var_dump($excel_arr);
// 値を追加したい時は番号を入れてもよいが、array_pushや$array2[] = $arrなどを使うと自動的に入る

// 補足
$arr = [
    'saito',
    'tomohiko',
    'chiba',
    'PHP'
];
[$familyName, $firstName, $pref, $language] = $arr;
echo $familyName, $firstName, $pref, $language

?>
