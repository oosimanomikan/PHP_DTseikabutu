<?php
namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;
//use root\Commoon;


$db = new PDODatabase(
     Bootstrap::DB_HOST,
     Bootstrap::DB_USER,
     Bootstrap::DB_PASS,
     Bootstrap::DB_NAME,
     Bootstrap::DB_TYPE
);

$ses = new Session($db);
//$con = new Common($db);

// テンプレート指定
$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);

$err = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF対策 - トークンを確認
    // if ($_POST["token"] != $ses->getSession('token')) {
    //     $err[] = '不正なリクエストです。';
    // } else {
        // $email = filter_input(INPUT_POST, 'email');
        // if (!$email) {
        //     $err[] = 'メールアドレスを記入してください。';
        // }

       

        $password = filter_input(INPUT_POST, 'password');
        if ($password === false || $password === '') {
            $err[] = 'パスワードを入力してください。';
        } else {
            // 正規表現
            if (!preg_match("/\A[a-z\d]{6,20}+\z/i",$password)) {
                $err[] = 'パスワードは英数字6文字以上20文字以下にしてください。';
            } else {
                $password_conf = filter_input(INPUT_POST, 'password_conf');
                if ($password !== $password_conf) {
                    $err[] = '確認用パスワードと異なっています。';
                }

                // パスワードのハッシュ化
                // if(!empty($password)) {
                //     $password = password_hash($password, PASSWORD_DEFAULT);
                // }
            }
        }
    //}
}

if (isset($_POST['email']) === false) {
    $dataArr['email'] = "";
}


// CSRF対策 - トークンの生成
//random_bytes(32) は、32バイト（256ビット）のランダムなバイト列を生成します。この関数は暗号学的に安全な乱数を生成するため、トークン生成などに利用されます。
//bin2hex() 関数は、バイナリデータを16進数の表現に変換します。つまり、この関数は引数としてバイナリ文字列を取り、それぞれのバイトを2文字の16進数に変換します。その結果、元のバイナリ文字列の2倍の長さの文字列が生成されます
// $token = bin2hex(random_bytes(32));
// $ses->setSession('token', $token);

$context = [];
$context['err_msg'] = $err;
// $context['csrf_token'] = $token;  // トークンをテンプレートに渡す
$template = $twig->load('User/Start_page/Login.html.twig');
$template->display($context);
?>
