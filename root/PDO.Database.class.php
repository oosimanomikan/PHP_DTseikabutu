<?
namespace nama_PHP;

class PDODatabase
{
    private $dbh = null;
    private $db_host = '';
    private $db_user = '';
    private $db_pass = '';
    private $db_name = '';
    private $db_type = '';

    public function __construct(
        $db_host,
        $db_user,
        $db_pass,
        $db_name,
        $db_type
    ) {
        $this->dbh = $this->connectDB(
            $db_host,
            $db_user,
            $db_pass,
            $db_name,
            $db_type
        );
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    private function connectDB(
        $db_host,
        $db_user,
        $db_pass,
        $db_name,
        $db_type
    ) {
        try {
            switch ($db_type) {
                case 'mysql':
                    $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
                    $dbh = new \PDO($dsn, $db_user, $db_pass);
                    $dbh->query('SET NAMES utf8');
                    break;
                case 'pgsql':
                    $dsn = 'pgsql:dbname=' . $db_name . ' host=' . $db_host . ' port=5432';
                    $dbh = new \PDO($dsn, $db_user, $db_pass);
                    break;
            }
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            exit();
        }
        return $dbh;
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
?>