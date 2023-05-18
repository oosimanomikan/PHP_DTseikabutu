<?php
namespace root\User;

// 必要なクラスをインクルードまたはオートロードします
require_once dirname(__FILE__) . '/Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// データベースに接続します
$db = new PDODatabase(
    Bootstrap::DB_HOST,
    Bootstrap::DB_PASS,
    Bootstrap::DB_USER,
    Bootstrap::DB_NAME,
    Bootstrap::DB_TYPE
);

// 会員一覧を取得するSQLを準備します
$sql = 'SELECT * FROM users ORDER BY id ASC';

// SQLを準備します
$stmt = $db->prepare($sql);
// SQLを実行します
$stmt->execute();

// 結果を取得します
$users = $stmt->fetchAll(\PDO::FETCH_ASSOC);  // ここでグローバルの PDO を参照

// Twigを初期化します
$loader = new FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new Environment($loader);

// テンプレートに変数を渡して表示します
echo $twig->render('user_list.twig', ['users' => $users]);
?>
