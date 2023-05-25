<?php
////login.html.twigのログイン画面へ飛ばして、login.html.twigの中で以下のコードのようにvalidation.phpへtwig遷移させて、validation.html.twigにバリデーションのエラー内容を記載する <input type="hidden" name="entry_url" id="entry_url" value="{{constant('member\\Bootstrap::ENTRY_URL')}}"><form method="post" action="confirm.php">
//ログイン認証に成功したときは、Home.phpに画面遷移が成功できるようにコードを作成する。

namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;
use root\Validation;



$db = new PDODatabase(
     Bootstrap::DB_HOST,
     Bootstrap::DB_USER,
     Bootstrap::DB_PASS,
     Bootstrap::DB_NAME,
     Bootstrap::DB_TYPE
);

$ses = new Session($db);
$val = new Validation();

// テンプレート指定
$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);


        //この値を入れないでPOSTするとUndefinedになるので、未定義の場合は空白状態としてセットしておく
        if (isset($_POST['email']) === false) {
            $dataArr['email'] = "";
        }

        if (isset($_POST['password']) === false) {
            $dataArr['password'] = [];
        }

        //エラーメッセージの配列作成
         $errArr = $Validation->errorCheck($dataArr);
         $err_check = $Validation->getErrorFlg();


         $template = ($err_check === true) ? 'User/Start_page/Home.html.twig' : 'User/Start_page/Login.html.twig';




        if ($res === true) {
            //登録成功時は完成ページへ
            header('Location: ' . Bootstrap::ENTRY_URL . 'User/Start_page/Home.php');
            exit();
        } else {

            //登録失敗時は登録画面に戻る
            $template = 'User/Start_page/Home.html.twig';
            foreach ($dataArr as $key => $value) {
                $errArr[$key] = '';
            }
        }

$context = [];
$template = $twig->load('User/Start_page/Login.html.twig');
$template->display($context);


?>
