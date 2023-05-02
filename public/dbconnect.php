<?php
require_once 'env.php';

function connect()
{
    $host = 'localhost';
    $db   = 'shopping_db';
    $user = 'blog_user';
    $pass = 'root';

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch(PDOException $e) {
        echo '接続失敗です！'. $e->getMessage();
        exit();
    }
}

