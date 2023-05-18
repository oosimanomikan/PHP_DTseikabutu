<?php
namespace root\User; 
// 必要なクラスをインクルードまたはオートロードします
require_once dirname(__FILE__) . '/Bootstrap.class.php';
use root\Bootstrap;
use root\PDODatabase;
use PDO; 


// データベースに接続します
$db = new PDODatabase(
    Bootstrap::DB_HOST,
    Bootstrap::DB_PASS,
    Bootstrap::DB_USER,
    Bootstrap::DB_NAME,
    Bootstrap::DB_TYPE
);

// セッションからユーザーIDを取得します
session_start();
$customer_no = $_SESSION['id'];

class Edit {
    private $cart;
    private $customer_no;

    public function __construct($cart, $customer_no) {
        $this->cart = $cart;
        $this->customer_no = $customer_no;
    }

    public function updateQuantity() {
        if (isset($_POST['update_quantity'])) {
            $item_id = $_POST['item_id'];
            $new_quantity = $_POST['new_quantity'];
        
            $res = $this->cart->updateCartQuantity($this->customer_no, $item_id, $new_quantity);
            // 更新に失敗した場合、エラーメッセージを表示
            if ($res === false) {
                echo "カート内の商品数量の更新に失敗しました。";
                exit();
            }
        }
    }

    public function emptyCart() {
        if (isset($_POST['empty_cart'])) {
            $res = $this->cart->emptyCart($this->customer_no);
            // 削除に失敗した場合、エラーメッセージを表示
            if ($res === false) {
                echo "カートの空にする処理に失敗しました。";
                exit();
            }
        }
    }
}

//追加するべきコードを考慮する必要あり、