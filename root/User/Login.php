<?php

namespace root\User;

require_once dirname(__FILE__) . '/Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;


$db = new PDODatabase(
    Bootstrap::DB_HOST,
    Bootstrap::DB_USER,
    Bootstrap::DB_PASS,
    Bootstrap::DB_NAME,
    Bootstrap::DB_TYPE
);

$ses = new Session($db);

// テンプレート指定
$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);

$template = $twig->load('twig/User/Login.html.twig');
$template->display($context);

$err_msg = "";

//②サブミットボタンが押されたときの処理
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // バリデーション
    if (empty($username)) {
        $err_msg = "ユーザー名が未入力です。";
    } else if (empty($password)) {
        $err_msg = "パスワードが未入力です。";
    }

    // エラーメッセージが空（バリデーションが通った）の場合、DB処理を行う
    if (empty($err_msg)) {
        // この部分で$resultを定義し、データベースからユーザー情報を取得する必要があります
        // 以下はダミーの結果です
        $result = [1];

        try {
            //④ログイン認証ができたときの処理
            if ($result[0] != 0){
                header('Location: http://localhost/root/Home.php');
                exit;
            }
            //⑤アカウント情報が間違っていたときの処理
            else{
                $err_msg = "アカウント情報が間違っています。";
            }
        }
        //⑥データが渡って来なかったときの処理
        catch (\PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
?>





