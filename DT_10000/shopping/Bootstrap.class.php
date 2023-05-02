<?php
    // Bootstrapの設定に関するコード

    namespace shopping;

    date_default_timezone_set('Asia/Tokyo');

    require_once dirname(__FILE__) . './../vendor/autoload.php';
    
    class Bootstrap
    {
        const DB_HOST = 'localhost';
        const DB_NAME = 'shopping_db';
        const DB_USER = 'shopping_user';
        const DB_PASS = 'shopping_pass';
        const DB_TYPE = 'mysql';

        //macユーザーは下段
        const APP_DIR = '/Applications/MAMP/htdocs/DT/';
        
        //const APP_DIR = '/Applications/XAMPP/xamppfiles/htdocs/DT/';
        const TEMPLATE_DIR = self::APP_DIR . 'templates/shopping/';
        const CACHE_DIR = false;
        
        //const CACHE_DIR = self::APP_DIR . 'templates_c/shopping/';
        const APP_URL = 'http://localhost:8888/DT/';
        const ENTRY_URL = self::APP_URL . 'shopping/';
        
        public static function loadClass($class)
        {
            $path = str_replace('\\', '/', self::APP_DIR . $class . '.class.php');
            require_once $path;
        }
    }
    // これを実行しないとオートローダーとして動かない
    spl_autoload_register([
    'shopping\Bootstrap',
    'loadClass'
    ]);
?>