<?php

// URL:http://localhost/DT/get/get.php
var_dump($_GET);
// $_GET:スーパーグローバル変数（定義済みの変数）の一つ。連想配列として使用する。

$data = [
    '渡辺',
    '佐藤',
    '田中'
];

$id = (isset($_GET['id']) === true) ? $_GET['id'] : '';

if ($id !== '') echo $data[$id];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GETテスト</title>
</head>
<body>
    <p>
        <a href="http://localhost:8888/DT/get/get.php?id=0">クリックすると渡辺さんが表示されます</a>
    </p>
    <p>
        <a href="http://localhost:8888/DT/get/get.php?id=1">クリックすると佐藤さんが表示されます</a>
    </p>
    <p>
        <a href="http://localhost:8888/DT/get/get.php?id=2">クリックすると田中さんが表示されます</a>
    </p>
</body>
</html>
