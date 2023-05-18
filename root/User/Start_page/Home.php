<?php
    
namespace root;
require_once dirname(__FILE__) . '/Bootstrap.class.php';

$page = "list";

$shouldRedirect = false;
switch ($page) {
    case "list":
        // $pageが"list"の場合、list.phpにリダイレクトします。
        $redirectLocation = 'Location: root\User\List.php';
        $shouldRedirect = true;
        break;
    case "mypage":
        // $pageが"mypage"の場合、mypage.phpにリダイレクトします。
        $redirectLocation = 'Location: root\User\Mypage.php';
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

    $template = $twig->load('twig\User\Home.html.twig');
    $template->display($context);
}
?>
