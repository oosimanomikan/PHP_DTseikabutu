<?php

require dirname(__FILE__) . '/' . $class . '.class.php';
class ClassLoader
{

    public static function loadClass($class)
    {
        require_once dirname(__FILE__) . '/' . $class . '.class.php';
    }
}

spl_autoload_register([
    'ClassLoader',
    'loadClass'
]);

$foo = new Foo();
$hoge = new Hoge();
