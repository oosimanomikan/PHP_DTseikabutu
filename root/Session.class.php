<?php

namespace root;

class Session
{
    public $session_key = '';
    public $db = NULL;

    public function __construct($db)
    {
        // セッションをスタートする
        session_start();
        // セッションIDを取得する
        $this->session_key = session_id();
        // DBの登録
        $this->db = $db;
    }

    public function logout() {
        // セッション変数を全て削除
        $_SESSION = array();

        

        // セッションを切断するにはセッションクッキーも削除する
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        

        // セッションクリア
        @session_destroy();
    }

    

    public function checkSession()
    {
        // セッションIDのチェック
        $id = $this->selectSession();
        
        // セッションIDがある(過去にショッピングカートに来たことがある)
        if ($id !== false) {
            $_SESSION['id'] = $id;
            //var_dump($_SESSION);
        } else {
            // セッションIDがない(初めてこのサイトに来ている)
            $res = $this->insertSession();
            
            if ($res === true) {
                $_SESSION['id'] = $this->db->getLastId();
            } else {
                $_SESSION['id'] = '';
            }
        }
    }

    private function selectSession()
    {
        $table = ' session ';
        $col =   ' id ';
        $where = ' session_key = ? ';
        $arrVal = [$this->session_key];
        
        $res = $this->db->select($table, $col, $where, $arrVal);
//コードの書き方的に、 (count($res) !== 0)の場合、正解なら、 $res[0]['customer_no'] であり、不正解なら、  : false;であるため,$res[0]['customer_no']でも問題ない。
        return (count($res) !== 0) ? $res[0]['id'] : false;
    }

    private function insertSession()
    {
        $table = 'session';
        $insData = ['session_key' => $this->session_key];
        
        $res = $this->db->insert($table, $insData);
        
        return $res;
    }

    // public function getSession($key) {
    //     return $_SESSION[$key] ?? null;
    // }

    // public function setSession($key, $value) {
    //     // セッションにキーと値を設定する
    //     $_SESSION[$key] = $value;
    // }
}
?>
