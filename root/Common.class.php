<?php
    
namespace root\User\Start_page;
require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

class Common{
    
    public function __construct()
    {
    }


    public function carts()
    {
        // プリペアドステートメントの準備
        $stmt = $this->dbh->prepare('SELECT * FROM carts');

        // プリペアドステートメントの実行
        $stmt->execute();

        // 結果の取得
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // 結果の表示
        foreach ($result as $row) {
            for ($i = 1; $i <= 8; $i++) {
                echo 'カラム' . $i . '<br>';
            }
        }
    }

    public function categories()
    {
        // プリペアドステートメントの準備
        $stmt = $this->dbh->prepare('SELECT * FROM categories');

        // プリペアドステートメントの実行
        $stmt->execute();

        // 結果の取得
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // 結果の表示
        foreach ($result as $row) {
            for ($i = 1; $i <= 3; $i++) {
                echo 'カラム' . $i . '<br>';
            }
        }
    }

    


    public function items()
    {
        // プリペアドステートメントの準備
        $stmt = $this->dbh->prepare('SELECT * FROM items');

        // プリペアドステートメントの実行
        $stmt->execute();

        // 結果の取得
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // 結果の表示
        foreach ($result as $row) {
            for ($i = 1; $i <= 18; $i++) {
                echo 'カラム' . $i . '<br>';
            }
        }
    }

    public function sessions()
    {
        // プリペアドステートメントの準備
        $stmt = $this->dbh->prepare('SELECT * FROM sessions');

        // プリペアドステートメントの実行
        $stmt->execute();

        // 結果の取得
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // 結果の表示
        foreach ($result as $row) {
            for ($i = 1; $i <= count($row); $i++) {
                echo 'カラム' . $i . '<br>';
            }
        }
    }

    public function users()
    {
        // プリペアドステートメントの準備
        $stmt = $this->dbh->prepare('SELECT * FROM users');

        // プリペアドステートメントの実行
        $stmt->execute();

        // 結果の取得
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // 結果の表示
        foreach ($result as $row) {
            for ($i = 1; $i <= count($row); $i++) {
                echo 'カラム' . $i . '<br>';
            }
        }
    }
}