<?php

namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;
use root\Common;

$ses = new Session($db);

$page = "list";


$shouldRedirect = false;
switch ($page) {
    case "list":
        // $pageが"list"の場合、list.phpにリダイレクトします。
        $redirectLocation = 'Location: root\User\Start_page\List.php';
        $shouldRedirect = true;
        break;
    case "mypage":
        // $pageが"mypage"の場合、mypage.phpにリダイレクトします。
        $redirectLocation = 'Location: root\User\Mypage\Mypage.php';
        $shouldRedirect = true;
        break;
    default:
        // $pageが予期せぬ値を持っていた場合のエラーハンドリングをここに書くことができます。
        echo "Unexpected value of page";
}

if ($shouldRedirect) {
    header($redirectLocation);
    exit;
} else {
    $loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
    $twig = new \Twig\Environment($loader, [
    'cache' => Bootstrap::CACHE_DIR
    ]);

    $template = $twig->load('User\Home.html.twig');
    $template->display($context);
}
?>
