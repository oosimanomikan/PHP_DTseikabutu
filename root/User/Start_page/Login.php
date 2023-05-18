<?php

namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

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

try {
    session_start();

    if (isset($_SESSION['USER'])) {
        // ログイン済みの場合はHOME画面へ
        redirect('/works/web/login.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POST処理時

        check_token();

        // 1.入力値を取得
        $user_no = $_POST['user_no'];
        $password = $_POST['password'];

        // 2.バリデーションチェック
        $err = array();

        if (!$user_no) {
            $err['user_no'] = '社員番号を入力してください。';
        } elseif (!preg_match('/^[0-9]+$/', $user_no)) {
            $err['user_no'] = '社員番号を正しく入力してください。';
        } elseif (mb_strlen($user_no, 'utf-8') > 20) {
            $err['user_no'] = '社員番号が長すぎます。';
        }

        if (!$password) {
            $err['password'] = 'パスワードを入力してください。';
        }

        if (empty($err)) {
            // 3.データベースに照合
            $pdo = connect_db();

            $sql = "SELECT * FROM user WHERE user_no = :user_no LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':user_no', $user_no, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // 4.ログイン処理（セッションに保存）
                $_SESSION['USER'] = $user;

                // 5.HOME画面へ遷移
                redirect('/works/web/login.php');
            } else {
                $err['password'] = '認証に失敗しました。';
            }
        }
    } else {
        // 画面初回アクセス時
        $user_no = "";
        $password = "";

        set_token();
    }

    $page_title = 'ログイン';
} catch (Exception $e) {
    echo  $e;
    //redirect('/works/web/error.php');
}
 
$context = [];
$template = $twig->load('User/Login.html.twig');
$template->display($context);

?>




