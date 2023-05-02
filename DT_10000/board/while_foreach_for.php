<?php
/*
* ファイルパス(Mac): /Applications/MAMP/htdocs/DT/board/while_foreach_for.php
* ファイル名: while_foreach_for.php
* アクセスURL(Mac): http://localhost:8888/DT/board/while_foreach_for.php
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html ; charset=UTF-8">
    <title>PHPスクール1日目〜while_foreach_for</title>
</head>

<body>
    <?php
    //繰り返し処理：whileの場合
    /**
     * *********************************
     */
    // $i = 1;
    // while ($i <= 10) {
    //     echo $i;
        // インクリメント（加算子）：↑＋1しろ！($i = +1)
        // デクリメント（減算子）：$i--;
        // 加算代入(+=)、減算代入(-=)、乗算代入(*=)、除算代入(/=)、剰余代入(%=)、連結代入(.=)
    // }
    // echo '<br><br>';
    /**
     * *********************************
     */
    // 初期値；forを実行する条件；インクリメント
    // for($i = 初期値; $i <= ループさせる回数; $i++(インクリメント)){
    // 処理内容
    //}

    for ($i = 1; $i <= 10; $i++) {
        echo $i . '<br>';
    }
    echo '<br><br>';

    // forが出来て、何が嬉しいのか？
    // まとめることによって列挙したり、数を数えたりできる

    $arr = [
        'saito',
        'tomohiko',
        'chiba',
        'PHP'
    ];
    // echo $arr[0];
    // echo $arr[1];
    // echo $arr[2];
    // echo $arr[3];
    echo '****************************<br>';

    // count():引数内の要素をカウント
    $num = count($arr);
    // var_dump($num);
    for ($i = 0; $i < $num; $i++) {
        echo $arr[$i] . '<br>';
    }
    echo '<br><br>';
    /**
     * ***************************************
     */
    // 上記のforと一緒だが初期値の設定や配列の数を数える必要が無く
    // 一気に展開ができる
    // 通常、配列のループ処理にはほとんどこちらを使う
    foreach ($arr as $key => $value) {
        echo $key;
        echo $value . '<br>';
        // $str = $value;
        // var_dump($str);
    }
    echo '<br><br>';
    /**
     * ****************************************
     */
    $label_arr = [
        'family_name' => 'saito',
        'first_name' => 'tomohiko',
        'pref' => 'chiba',
        'language' => 'PHP'
    ];

    foreach ($label_arr as $label => $data) {
        echo $label;
        echo ' : ';
        echo $data . '<br>';
    }
    echo '<br><br>';
    /**
     * *****************************************
     */
    $excel_arr = [
        [
            'family_name' => 'saito',
            'first_name' => 'tomohiko',
            'pref' => 'chiba',
            'age' => '33',
            'language' => 'PHP'
        ],
        [
            'family_name' => 'tanaka',
            'first_name' => 'youhei',
            'pref' => 'tokyo',
            'age' => '19',
            'language' => 'C'
        ],
        [
            'family_name' => 'sato',
            'first_name' => 'ichiro',
            'pref' => 'kanagawa',
            'age' => '28',
            'language' => 'Java'
        ]
    ];
    foreach ($excel_arr as $no => $member_data) {
        echo 'No' . $no . '<br>';
        // var_dump($member_data);
        echo 'family_name : ' . $member_data['family_name'] . '<br>';
        echo 'first_name  : ' . $member_data['first_name'] . '<br>';
        echo 'pref        : ' . $member_data['pref'] . '<br>';
        echo 'age         : ' . $member_data['age'] . '<br>';
        echo 'language    : ' . $member_data['language'] . '<br>';
        echo '<br><br>';
    }
    // while
    /**
     * *******************************************
     */
    $j = 1;

    $flg = true;
    // true → false (on → off)
    while ($flg === true) {
        if ($j === 10)
            $flg = false;
        echo $j;
        $j++;
    }
    echo '<br><br>';
    /**
     * *******************************************
     */
    // (2日目授業時に説明)ファイルポインタ　本のしおり
    $fp = fopen('sample_text.txt', 'r');
    // $fp : リソース型の変数
    // 'r': 読み取り専用　'w': 書き込み（ファイルポインタ先頭）'a': 書き込み（ファイルポインタ終端、追記）
    $flg = true;

    while ($flg === true) {
        // fgets ← データの情報をとってくる
        $res = fgets($fp);
        // fgetsが終点に到達するとfalseを返します。
        if ($res === false)
            $flg = false;
        echo $res . '<br>';
    }
    fclose($fp);
    echo '<br><br>';
    /**
     * ********************************************
     */
    foreach ($excel_arr as $member_data) {
        // var_dump($member_data);
        if ($member_data['age'] >= 30) {
            echo $member_data['family_name'] . 'さんは30代です。<br>';
        } elseif ($member_data['age'] >= 20) {
            echo $member_data['family_name'] . 'さんは20代です。<br>';
        } else {
            echo $member_data['family_name'] . 'さんは10代です。<br>';
        }
    }
    /**
     * ********************************************
     */
    echo '<table border = "1px">';
    echo '<tr>';
    echo '<td>family_name</td>';
    echo '<td>first_name</td>';
    echo '<td>pref</td>';
    echo '<td>age</td>';
    echo '<td>language</td>';
    echo '</tr>';
    foreach ($excel_arr as $member) {

        echo '<tr>';
        echo '<td>' . $member['family_name'] . '</td>';
        echo '<td>' . $member['first_name'] . '</td>';
        echo '<td>' . $member['pref'] . '</td>';
        echo '<td>' . $member['age'] . '</td>';
        echo '<td>' . $member['language'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
</body>

</html>
