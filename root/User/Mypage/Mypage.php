<?php
try {
    // 何らかの処理

    // 処理が成功したらcsv.phpにリダイレクト
    header('Location: root\User\Mypage\csv.php');
    exit();
} catch (Exception $e) {
    // エラーが発生したらDelete.phpにリダイレクト
    header('Location: root\User\Mypage\Delete.php');
    exit();
}

try {
    // 他の何らかの処理

    // 処理が成功したらMypage.phpにリダイレクト
    header('Location: root\User\Mypage\Mypage.php');
    exit();
} catch (Exception $e) {
    // エラーが発生したらPurched.phpにリダイレクト
    header('Location:root\User\Mypage\Purched.history.php');
    exit();
}

// Show.phpに遷移
header('Location: root\User\Mypage\Show.history.php');
exit();
?>
