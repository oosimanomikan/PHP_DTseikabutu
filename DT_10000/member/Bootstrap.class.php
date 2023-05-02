<?php
/*
ファイルパス（Mac）：/Applications/MAMP/htdocs/DT/member/Bootstrap.class.php
アクセスURL（Mac)：http://localhost:8888/DT/member/Bootstrap.class.php
*/

namespace member;

require_once dirname(__FILE__) . './../vendor/autoload.php';

class Bootstrap
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'member_db';
    const DB_USER = 'member_user';
    const DB_PASS = 'member_pass';

    //Macユーザー
    const APP_DIR = '/Applications/MAMP/htdocs/DT/';
    
    const TEMPLATE_DIR = self::APP_DIR . 'templates/member/';

    const CACHE_DIR = false;
    //const CACHE_DIR = self::APP_DIR . 'templates_c/member/';

    const APP_URL = 'http://localhost:8888/DT/';

    const ENTRY_URL = self::APP_URL . 'member/';

    public static function loadClass($class)
    {
        $path = str_replace('\\', '/', self::APP_DIR . $class . '.class.php');
        require_once $path;
    }
}

//これを実行しないとオートローダーとして動かない
spl_autoload_register([
    'member\Bootstrap',
    'loadClass'
]);
