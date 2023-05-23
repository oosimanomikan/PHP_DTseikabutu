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
        //session.use_cookiesによりクライアント側にセッ ションIDを保存する際にクッキーを使用するかどうかを指定します。デ フォルトは1 (有効)です。
        if (ini_get("session.use_cookies")) {
        //現在のセッションクッキーのパラメータを取得します。
            $params = session_get_cookie_params();
        //setcookie() 関数を使って、セッションクッキーを空（''）に設定します。また、クッキーの有効期限を現在の時間（time()）から42000秒前に設定します。これにより、クッキーはすぐに期限切れになり、ブラウザはそれを削除します
            setcookie(session_name(), '', time() - 42000,
        //削除するクッキーのパラメータを設定します。これらのパラメータは先ほど取得したものを使用します。パス、ドメイン、セキュリティ設定、HttpOnly設定を指定しています。クッキーの有効期限を現在時間から42000秒前に設定する理由は、これが一般的な方法であり、クッキーをすぐに無効にするのに十分な時間です
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
        //HttpOnlyフラグは、ウェブブラウザが扱うクッキーの一種で、JavaScriptなどのクライアントサイドスクリプトからアクセスすることを防止する役割を持っています。HttpOnlyフラグが設定されたクッキーは、サーバーとブラウザ間のHTTPやHTTPS通信中にのみ使用されます。このフラグの主な目的は、クロスサイトスクリプティング（XSS）攻撃からクッキーを保護することです。XSS攻撃とは、攻撃者が悪意のあるスクリプトをウェブページに注入し、他のユーザーの情報を盗み出す種類の攻撃です。攻撃者がJavaScriptを使用してユーザーのクッキーを盗むことを防ぐために、HttpOnlyフラグが使用されます。


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
