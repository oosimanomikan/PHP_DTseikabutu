<?php
namespace root;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

// use root\PDODatabase;

class Common
{
    private $dataArr = [];
    private $errArr = [];
    private $dbh; 

    //初期化
    public function __construct(PDODatabase $dbh)
    {
        $this->dbh = $dbh;  
    }

    public function errorCheck($dataArr)
    {
        $this->dataArr = $dataArr;

        //クラス内のメソッドを読み込む
        $this->carts();
        $this->categories();
        $this->items();
        $this->sessions();
        $this->mailCheck();
        $this->users();
       

        return $this->errArr;
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
            for ($i = 1; $i <= count($row); $i++) {
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
    
        public function mailCheck()
        {
            if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+[a-zA-Z0-9\._-]+$/', $this->dataArr['email']) === 0){
                $this->errArr['email'] = 'メールアドレスを正しい形式で入力してください';
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
    