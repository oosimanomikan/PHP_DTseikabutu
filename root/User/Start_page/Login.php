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

$err = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!$email = filter_input(INPUT_POST, 'email')) {
        $err[] = 'メールアドレスを記入してください。';
    }
  
    $password = filter_input(INPUT_POST, 'password');
    // 正規表現
    if (!preg_match("/\A[a-z\d]{8,20}+\z/i",$password)) {
        $err[] = 'パスワードは英数字8文字以上20文字以下にしてください。';
    }

    $password_conf = filter_input(INPUT_POST, 'password_conf');
    if ($password !== $password_conf) {
        $err[] = '確認用パスワードと異なっています。';
    }
}


$context = [];
$context['err_msg'] = $err;
$template = $twig->load('User/Start_page/Login.html.twig');
$template->display($context);

?>
