<?php
/* ファイルパス (Win): C:\xampp\htdocs\DT\board\board5.php 
 * アクセスURL (Win): http://localhost/DT/board/board5.php
 * ファイル名:board5.php
 * テンプレートフォルダ:C:\xampp\htdocs\DT\templates\board
 * 
 * 今回の学習内容:Twigの活用とファイル分割
 */
namespace board;

require_once dirname(__FILE__).'/Bootstrap.class.php';

use board\Bootstrap;

$db = new Database(Bootstrap::DB_HOST, Bootstrap::DB_USER, Bootstrap::DB_PASS, Bootstrap::DB_NAME);

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader,[
  'cache' => Bootstrap::CACHE_DIR
]);

$msg = '';
$err_msg = '';
if (isset($_POST['send']) === true) {
  $name = $_POST['name'];
  $contents = $_POST['contents'];

  if ($name !== '' && $contents !== '') {
    $query = "INSERT INTO board ("
    // .'name,'の,は nameとcontentを分かるために存在する。
    // .　で足し算を行う理由は、コードを簡潔に見やすくするためである。
    .'name,'
    ."contents"
    .")VALUES("
    //","が必要な理由は、　,を文字列にそれぞれ均等に配布するため
    //")"が必要な理由は、　,を文字列にそれぞれ均等に配布するため .")VALUES("の括弧を閉じるためである。
    .$db->str_quote($name).","
    .$db->str_quote($contents).")";
    var_dump($query);
    $res = $db->execute($query);
    if ($res !== false) {
      $msg = '書き込みに成功しました';
    } else {
      $err_msg = '書き込みに失敗しました';
    }
  } else {
    $err_msg = '名前とコメントを記入してください';
  }
}

$query = "SELECT"
        ." id, "
        ." name, "
        ." contents "
        ." FROM "
        ." board ";

$data = $db->select($query);

$db->close();
// 変数の設定

$context = [];

$context['msg'] = $msg;
$context['err_msg'] = $err_msg;
$context['data'] = $data;

$template = $twig->loadTemplate('board5.html.twig');
$template->display($context);

// 下記のような記述でも可
// echo $twig->render('board.html.twig', $data);
?>
