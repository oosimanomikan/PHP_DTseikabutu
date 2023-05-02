<!-- 
ファイルパス/Applications/MAMP/htdocs/DT/Javascript/form2.php
ファイル名：form2.php
アクセスURL：http://localhost/DT/Javascript/form2.php
 -->

 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Javascript</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="sample2.js"></script>
    </head>
    <style>
        #area{
            background-color: #ee82ee;
            width: 50px;
        }
    </style>
    <body>
        <form action="" method="post" >
            名前<input type="text" id="name_id" name="name" value=""><br>
            <input type="button" name="click" value="クリック" onclick="button_click();"><br>
            <input type="button" name="check" value="チェック" onclick="button_check();"><br>
        </form>
        <div id="write"></div>
        <div id="area">hoge</div>
    </body>
</html>
