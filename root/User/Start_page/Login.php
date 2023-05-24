<?php
namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;
use root\Common;


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


//登録完了
if (isset($_POST['complete']) === true) {
    $mode = 'complete';
}

//戻る場合
if (isset($_POST['back']) === true) {
    $mode = 'back';
}


//ボタンのモードによって処理を変える
switch ($mode) {
    case 'confirm': //新規登録
        //データを受け継ぐ
        //↓この情報は入力には必要ない
        unset($_POST['confirm']);

        $dataArr = $_POST;

        //この値を入れないでPOSTするとUndefinedになるので、未定義の場合は空白状態としてセットしておく
        if (isset($_POST['sex']) === false) {
            $dataArr['sex'] = "";
        }

        if (isset($_POST['traffic']) === false) {
            $dataArr['traffic'] = [];
        }

        //エラーメッセージの配列作成
        $errArr = $common->errorCheck($dataArr);
        $err_check = $common->getErrorFlg();

        //err_check = false →エラーがある！
        //err_check = true →エラーがない！
        //エラーがなければ confirm.tpl　あれば regist.tpl
        $template = ($err_check === true) ? 'confirm.html.twig' : 'regist.html.twig';

        break;

    case 'back':  //戻ってきた時
        //ポストされたデータを元に戻すので、$dataArrに入れる
        $dataArr = $_POST;

        unset($dataArr['back']);

        //エラーも定義しておかないと、Undefinedエラーが出る
        foreach ($dataArr as $key => $value) {
            $errArr[$key] = '';
        }

        $template = 'regist.html.twig';
        break;

    case 'complete':  //登録完了
        $dataArr = $_POST;

        //↓この情報はいらないので外しておく
        unset($dataArr['complete']);
        $column = '';
        $insData = '';

        // //foreachの中でSQL文を作る
        // foreach ($dataArr as $key => $value) {
        //     $column .= $key . ', ';
        //     if ($key === 'traffic') {
        //         $value = implode('_', $value);
        //     }
        //     $insData .= ($key === 'sex') ? $db->quote($value) . ',' : $db->str_quote($value) . ', ';
        // }

//         $query = " INSERT INTO member ( "
//             . $column
//             . " regist_date "
//             . " ) VALUES ( "
//             . $insData
//             . " NOW() "
//             . " ) ";
// var_dump($query);
//         $res = $db->execute($query);
//         $db->close();

        if ($res === true) {

            //登録成功時は完成ページへ
            header('Location: ' . Bootstrap::ENTRY_URL . 'complete.php');
            exit();
        } else {

            //登録失敗時は登録画面に戻る
            $template = 'regist.html.twig';

            foreach ($dataArr as $key => $value) {
                $errArr[$key] = '';
            }
        }
        break;
}


?>
