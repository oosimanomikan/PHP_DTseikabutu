<?php
namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

class Common
{
    private $dataArr = [];
    private $errArr = [];

    //初期化
    public function __construct()
    {
    }

    public function errorCheck($dataArr)
    {
        // （中略）

        return $this->errArr;
    }

    public function carts()
    {
        // （中略）
    }

    public function categories()
    {
        // （中略）
    }

    public function items()
    {
        // （中略）
    }

    public function sessions()
    {
        // （中略）
    }

    public function mailCheck()
    {
        if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+[a-zA-Z0-9\._-]+$/', $this->dataArr['email']) === 0){
            $this->errArr['email'] = 'メールアドレスを正しい形式で入力してください';
        }
    }

    public function users()
    {
        // （中略）
    }
}
?>
