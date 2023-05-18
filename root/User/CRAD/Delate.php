<?php
namespace root\User;
// 必要なクラスをインクルードまたはオートロードします
require_once dirname(__FILE__) . '/Bootstrap.class.php';
use root\Bootstrap;
use root\PDODatabase;
use root\Session;
use root\Item;


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
$userId = $_SESSION['user_id'];  // ここは実際のセッション変数名に合わせて変更してください

// SQL文の作成
$sql = "DELETE FROM users WHERE id = ?";

// プリペアドステートメントの準備
$stmt = $db->prepare($sql);

// パラメータのバインド
$stmt->bindValue(1, $userId);

// SQLの実行
if ($stmt->execute()) {
    // セッションの破棄
    session_destroy();
    
    // リダイレクト
    header('Location: root\Admin\Member.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>"; // ここでエラーを表示する方法を修正
}
?>


