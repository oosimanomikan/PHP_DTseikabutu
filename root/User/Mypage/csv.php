<?php

try {
    // データベースに接続
    $dbh = new PDO($dsn, $user, $password);

    // 売上データを取得するSQL文
    $sql = 'SELECT * FROM items';

    // SQLを実行し、結果を取得
    $stmt = $dbh->query($sql);

    // 結果を配列として取得
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // HTMLテーブルを出力
    echo '<table>';
    echo '<tr><th>ID</th><th>Date</th><th>Sales</th></tr>';
    foreach ($sales as $sale) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($sale['id'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($sale['date'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . htmlspecialchars($sale['sales'], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '</tr>';
    }
    echo '</table>';

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    die();
}
?>

