<?php
$operation = "process1"; // これはあなたのロジックに基づいて変更します。

try {
    if ($operation == "process1") {
        // 何らかの処理

        // 処理が成功したらcsv.phpにリダイレクト
        header('Location: root\User\Mypage\csv.php');
        exit();
    } elseif ($operation == "process2") {
        // 他の何らかの処理

        // 処理が成功したらMypage.phpにリダイレクト
        header('Location: root\User\Mypage\Mypage.php');
        exit();
    } else {
        // Show.phpに遷移
        header('Location: root\User\Mypage\Show.history.php');
        exit();
    }
} catch (Exception $e) {
    if ($operation == "process1") {
        // エラーが発生したらDelete.phpにリダイレクト
        header('Location: root\User\Mypage\Delete.php');
        exit();
    } elseif ($operation == "process2") {
        // エラーが発生したらPurched.phpにリダイレクト
        header('Location:root\User\Mypage\Purchased.history.php');
        exit();
    }
}
?>
