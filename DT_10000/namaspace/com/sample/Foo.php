<?php
/* 
 * ファイルパス (Win): C:\xampp\htdocs\DT\namespace\com\sample\Foo.php 
 * URL (Win): http://localhost/DT/namespace/com/sample/Foo.php
 *
 */
namespace Com\Sample;

require_once 'Hoge.php';

// 同一の名前空間上にあればクラス名をダイレクトに使える。
$hoge = new Hoge();

class Foo
{
  public function __construct()
  {
    echo "this is foo class<br>";
  }
}
?>