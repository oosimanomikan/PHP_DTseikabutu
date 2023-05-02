<?php
/* 
 * ファイルパス (Win): C:\xampp\htdocs\DT\autoload\index.php 
 * URL (Win): http://localhost/DT/autoload/index.php
 */
class ClassLoader
{
  public static function loadClass($class)
  {
    require_once dirname(__FILE__).'/'.$class.'.class.php';
  }
}

// これを実行しないとオートローダーとして動かない
spl_autoload_register([
  'ClassLoader',
  'loadClass'
]);

$foo = new Foo();
$hoge = new Hoge();
?>