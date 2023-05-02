<?php
//DBから取得するコード

















$name = "PHP自己学習";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>掲示板_DB_twig版</title>
</head>
<body>
<h1>
<?php
echo $name;
echo "\n";
?>
</h1>
<form method="post" action="">
    <table>
        <tr>
            <th>名前</th>
            <td><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <th>コメント</th>
            <td><textarea name="contents" rows="4" cols="20"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="send" value="書き込む"></td>
        </tr>
    </table>
</form>
<table>
    <tr>
        <th>&nbsp;</th>
        <th>名前</th>
        <th>コメント</th>
    </tr>
</table>
</body>
</html>
