<?php
/*
ファイルパス(Mac)：/Applications/MAMP/htdocs/DT/board/Database.class.php
ファイル名：Database.class.php
*/
namespace board;
class Database
{
    // $db_con =$db_constructorです。
    private $db_con = null;
    private $db_host = '';
    private $db_user = '';
    private $db_pass = '';
    private $db_name = '';

    // __construct：アンダースコアは2つ

//  $db_host = 'member';
//  $db_user = 'member_user';
//  $db_pass = 'member_pass';
//  $db_name = 'member_db';

 //$database = new Database($db_host, $db_user, $db_pass, $db_name);

    public function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_con = $this->connectDB($db_host, $db_user, $db_pass, $db_name);
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    private function connectDB($db_host, $db_user, $db_pass, $db_name)
    {
        $tmp_con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if ($tmp_con !== false) {
            return $tmp_con;
        } else {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function execute($sql)
    {
        return mysqli_query($this->db_con, $sql);
    }

    public function select($sql)
    {
        $res = $this->execute($sql);
        $data = [];
        while ($row = mysqli_fetch_array($res)) {
            array_push($data, $row);
        }
        // mysql_free_result($res);
        return $data;
    }

    public function quote($int)
    {
        return mysqli_real_escape_string($this->db_con, $int);
    }

    public function str_quote($str)
    {
        //"'";の意味は、escapした対象を''で囲うという意味である。
        return "'" . mysqli_real_escape_string($this->db_con, $str) . "'";
    }

    //db_con＝conはconstructorを指している。今回のコンストラクターは10行目のnullである。
    public function getLastId()
    {
        return mysqli_insert_id($this->db_con);
    }

    public function close()
    {
        mysqli_close($this->db_con);
    }
}
