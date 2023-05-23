<?php
namespace root;
// require_once 'env.php';

class PDODatabase
{
    private $pdo;

    public function __construct($charset = 'utf8mb4')
    {
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".$charset;

        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
            // 接続成功のメッセージを表示
            echo "データベースに接続成功しました！";
        } catch (\PDOException $e) {
            // エラーメッセージを出力
            echo 'データベース接続失敗: ' . $e->getMessage();
            // エラーメッセージをログに出力
            error_log('データベース接続失敗: ' . $e->getMessage());
        }
    }
}
