<?php
    // Bootstrapの設定に関するコード

    namespace root;

    date_default_timezone_set('Asia/Tokyo');

    require_once dirname(__FILE__) . './../vendor/autoload.php';
    
    class Bootstrap
    {
        const DB_HOST = 'localhost';
        const DB_NAME = 'blog_youtube';
        const DB_USER = 'blog_user';
        const DB_PASS = 'root';
        const DB_TYPE = 'mysql';

        //macユーザーは下段
        const APP_DIR = '/Applications/MAMP/htdocs/NAMA_PHP/';
        
        //const APP_DIR = '/Applications/XAMPP/xamppfiles/htdocs/DT/';
        const TEMPLATE_DIR = self::APP_DIR . 'twig/';
        const CACHE_DIR = false;
        
        //const CACHE_DIR = self::APP_DIR . 'templates_c/shopping/';
        const APP_URL = 'http://localhost:8888/NAMA_PHP/';

        const ENTRY_URL = self::APP_URL . 'root/';

        
      
        
        public static function loadClass($class)
        {
            //'loadClass'が未定義のクラスが存在する場合に、実行される。
            //$classには、名前空間+クラス名が格納される。
            $path = str_replace('\\', '/', self::APP_DIR . $class . '.class.php');

           
            //  var_dump($path);

            require_once $path;

        }
    }
    // これを実行しないとオートローダーとして動かない
    spl_autoload_register([
    //第一引数はnamespaceとクラスを指している。
    'root\Bootstrap',
    'loadClass'
    ]);
?>