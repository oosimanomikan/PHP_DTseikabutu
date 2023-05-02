<!--
ファイルパス：C:¥xampp¥htdocs¥DT¥javascript¥form.php
ファイル名：form.php
アクセスURL：http://localhost/DT/javascript/form.php
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>javascript</title>
    <script>
        /*
        function button_click()
        {
            alert('クリック');
        }

        function button_check()
        {
            var name = document.getElementById('name_id).value;

            if(name === ''){
                alert('名前が入力されていません');
            }else{
                document.getElementById('write').innerHTML = name;
                alert('入力された名前は' + name + 'です');
            }
        }
        */
    </script>
</head>
<body>
    <form method = "post" action="">
        名前<input type="text" id="name_id" name="name" value=""><br>
        <input type="button" name="click" value="クリック"
onclick="button_click();"><br>
        <input type="button" name="check" value="チェック"
onclick="button_check();"><br>
    </form>
    <div id="write"></div>
</body>
</html>
