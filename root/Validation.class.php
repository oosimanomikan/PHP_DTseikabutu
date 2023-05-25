<?php
namespace root;
class Validation                                                                                                                               
{
    private $dataArr = [];

    private $errArr = [];

    //初期化
    public function __construct()
    {
    }

    public function errorCheck($dataArr)
    {
        $this->dataArr = $dataArr;

        //クラス内のメソッドを読み込む
        $this->createErrorMessage();

        $this->mailCheck();
        $this->passwordCheck(); // メソッド名をpasswordCheckに変更

        return $this->errArr;
    }

    private function createErrorMessage()
    {
        foreach ($this->dataArr as $key => $val){
            $this->errArr[$key] = '';
        }
    }

    private function mailCheck()
    {
        if ($this->dataArr['email'] === ''){
            $this->errArr['email'] = 'メールアドレスもしくは、パスワードを正しい形式で入力してください';
        }
    }

    private function passwordCheck() // メソッド名をpasswordCheckに変更
    {
        if ($this->dataArr['password'] === ''){
            $this->errArr['password'] = 'メールアドレスもしくは、パスワードを正しい形式で入力してください';
        }
        
        if(!preg_match('/^.{6,20}$/', $this->dataArr['password'])){
            $this->errArr['password'] = 'パスワードは6文字以上20文字以下で入力してください';
        }
    }

    public function getErrorFlg()
    {
        $err_check = true;
        foreach($this->errArr as $key => $value) {
            if($value !== '') {
               $err_check = false;
            }
        }
        return $err_check;
    }
}
