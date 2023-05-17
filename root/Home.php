<?php
    
namespace root\User;
require_once dirname(__FILE__) . '/Bootstrap.class.php';

$page = "list";

switch ($page) {
    case "list":
        // $pageが"list"の場合、list.phpにリダイレクトします。
        header('Location: root\User\List.php');
        exit;
    case "mypage":
        // $pageが"mypage"の場合、mypage.phpにリダイレクトします。
        header('Location: root\User\Mypage.php');
        exit;
    default:
        // $pageが予期せぬ値を持っていた場合のエラーハンドリングをここに書くことができます。
        echo "Unexpected value of page";
        exit;
}

$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);

$template = $twig->load('twig\User\Home.html.twig');
$template->display($context);
?>