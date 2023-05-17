<?php
    // 購入を確認
    if (isset($_POST['purchase'])) {
        // カートに商品があるかを確認
        if ($sumNum > 0) {
            // 在庫のチェックと減少の処理
            foreach ($dataArr as $item) {
                $stock = $itm->getStock($item['item_id']);
                if ($stock < $item['num']) {
                    echo "在庫が足りません: " . $item['item_id'];
                    exit();
                } else {
                    $itm->decreaseStock($item['item_id'], $item['num']);
                }
            }

            // 顧客の注文履歴の更新
            $order = new Order($db);
            $order->addOrder($customer_no, $dataArr);
            
            // カートから商品を削除
            $cart->clearCart($customer_no);
            
            echo "購入が完了しました。";
        } else {
            echo "カートに商品がありません。";
        }
    }
?>
