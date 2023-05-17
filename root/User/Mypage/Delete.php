<?php
// 必要なクラスをインクルードまたはオートロードします
require_once dirname(__FILE__) . '/Bootstrap.class.php';
use root\Bootstrap;
use root\PDODatabase;

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
$customer_no = $_SESSION['customer_no'];

$userId = $_SESSION['user_id'];  // ここは実際のセッション変数名に合わせて変更してください

// SQL文の作成
$sql = "DELETE FROM users WHERE id = ?";

// プリペアドステートメントの準備
$stmt = $conn->prepare($sql);

// パラメータのバインド
$stmt->bind_param("i", $userId);

// SQLの実行
if ($stmt->execute()) {
    // セッションの破棄
    session_start();
    session_destroy();
    
    // リダイレクト
    header('Location: root\User\Mypage\Mypage.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// データベース接続のクローズ
$conn->close();
?>
上記のコードは、データベースからユーザーの情報を削除し、セッションを破棄してトップページにリダイレクトする基本的な処理を示しています。ただし、実際のアプリケーションではさまざまな要因を考慮に入れる必要があります。例えば、ユーザーが本当に退会したいのかを確認するための確認画面の表示、ユーザー情報を完全に削除するのではなく、退会したことを示すフラグを設定するなどの処理が必要になるかもしれません[1]。






