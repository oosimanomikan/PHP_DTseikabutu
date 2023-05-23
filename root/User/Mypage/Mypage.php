<?php

namespace root\User\Mypage;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;

// テンプレート指定
$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);

$err = [];
if  (isset($_POST["csv.php"])) :
    $csv = $_POST["csv.php"];
    // Do something with $csv here
    // Assuming you are validating something and it fails, you can push the error message to $err array
    // $err[] = 'Validation failed!';
endif;

$context = [];
$context['err_msg'] = $err;
$template = $twig->load('User/Mypage/Mypage.html.twig');
$template->display($context);

?>
