<?php

namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;

// テンプレート指定
$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);


$data = [];
try {
    // csv.phpに関する処理
    // ...
    $data['location'] = 'csv.php';
} catch (\Exception $e) {
    $data['error'] = 'エラーが発生しているため、ご希望のページに移動できません';
}

try {
    // Mypage.phpに関する処理
    // ...
    $data['location'] = 'Mypage.php';
} catch (\Exception $e) {
    $data['error'] = 'エラーが発生しているため、ご希望のページに移動できません';
}

try {
    // history.phpに関する処理
    // ...
    $data['location'] = 'history.php';
} catch (\Exception $e) {
    $data['error'] = 'エラーが発生しているため、ご希望のページに移動できません';
}

try {
    // Delete.phpに関する処理
    // ...
    $data['location'] = 'Delete.php';
} catch (\Exception $e) {
    $data['error'] = 'エラーが発生しているため、ご希望のページに移動できません';
}

try {
    // history.phpに関する処理
    // ...
    $data['location'] = 'history.php';
} catch (\Exception $e) {
    $data['error'] = 'エラーが発生しているため、ご希望のページに移動できません';
}
$context = [];
$context['err_msg'] = $err;
$template = $twig->load('User/Start_page/Login.html.twig');
$template->display($context);
?>

?>
