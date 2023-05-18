<?php
namespace root\User; 
// 必要なクラスをインクルードまたはオートロードします
require_once dirname(__FILE__) . '/Bootstrap.class.php';
use root\Bootstrap;
use root\PDODatabase;
use PDO; 

// データベースに接続します
$db = new PDODatabase(
    Bootstrap::DB_HOST,
    Bootstrap::DB_PASS,
    Bootstrap::DB_USER,
    Bootstrap::DB_NAME,
    Bootstrap::DB_TYPE
);

// セッションからユーザーIDを取得します
session_start();
$customer_no = $_SESSION['id'];

// ユーザーの購入履歴を取得するSQLを準備します
$sql = 'SELECT * FROM itemes  ORDER BY id ASC';

// SQLを実行します
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $customer_no, PDO::PARAM_INT);
$stmt->execute();

// 結果を取得します
$purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 結果を表示します
foreach ($purchases as $purchase) {
    echo '購入日: ' . htmlspecialchars($purchase['purchase_date'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo '商品名: ' . htmlspecialchars($purchase['item_name'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo '価格: ' . htmlspecialchars($purchase['price'], ENT_QUOTES, 'UTF-8') . '<br>';
    echo '<hr>'; // この行を追加
}
?>
