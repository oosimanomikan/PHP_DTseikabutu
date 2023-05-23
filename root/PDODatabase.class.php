<?php

namespace root;
class PDODatabase
{
    protected $pdo;
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
        $this->pdo = $this->dbh;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
        $this->db_type = $db_type;
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

    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }
}
