<?php

// 1-1
// CREATE DATABASE person_db default character SET utf8;

// 1-2
// grant all privileges on person_db.*to person_user@'localhost' identified by 'person_pass' with grant option;

// 1-3
// create table person_tb (
//   id int(11) unsigned not null auto_increment primary key,
//   name varchar(20) not null,
//   age int(11) not null,
//   language varchar(20) not null
// );

// 1-4
// desc person_db;

// 1-5
// INSERT INTO person_tb (name, age, language) VALUES ('yamada', 19, 'PHP');
// INSERT INTO person_tb (name, age, language) VALUES ('suzuki', 22, 'Java');
// INSERT INTO person_tb (name, age, language) VALUES ('tanaka', 18, 'Ruby');
// INSERT INTO person_tb (name, age, language) VALUES ('watanabe', 25, 'C');
// INSERT INTO person_tb (name, age, language) VALUES ('satou', 33, 'Perl');

// 1-6
// SELECT * FROM person_tb;

// 1-7
// SELECT * FROM person_tb WHERE age >= 20;

// 1-8
// UPDATE person_tb SET age = 23, language = 'Python' WHERE name = 'suzuki';

// 1-9
// SELECT SUM(age) AS '年齢の合計' , ROUND(AVG(age)) AS '年齢の平均' FROM person_tb;

// 2、3
// person_tbにカラムを追加
// ALTER TABLE person_tb ADD sex int(10) AFTER age;

$db_host_person = 'localhost';
$db_name_person = 'person_db';
$db_user_person = 'person_user';
$db_pass_person = 'person_pass';

$name = '';
$age = '';
$sex = '';
$language = '';

$msg = '';
$err_msg0 = '';
$err_msg1 = '';
$err_msg2 = '';
$err_msg3 = '';
$err_msg4 = '';
$err_msg5 = '';
$img_msg = '';
$img_err_msg1 = '';
$img_err_msg2 = '';

// データベースへ接続
$link_person = mysqli_connect($db_host_person, $db_user_person, $db_pass_person, $db_name_person);
if ($link_person !== false) {
    $query_person = "SELECT * FROM person_tb";
    $res_person = mysqli_query($link_person, $query_person);
    $data_person = [];
    while ($row_person = mysqli_fetch_assoc($res_person)) {
        $data_person[] = $row_person;
    }

    if (isset($_POST['send']) === true) {
        var_dump($_POST);
        // フォームで入力された値を取得
        if (isset($_POST['name']) === true) $name = $_POST['name'];
        if (isset($_POST['age']) === true) $age = $_POST['age'];
        if (isset($_POST['sex']) === true) $sex = $_POST['sex'];
        if (isset($_POST['language']) === true) $language = $_POST['language'];

        // エラーメッセージを設定
        if ($name === '') $err_msg1 = '名前を入力してください';
        if ($age === '') $err_msg2 = '年齢を入力してください';
        if ($age !== '' && $age < '20') $err_msg3 = '未成年は入力できません';
        if ($sex === '') $err_msg4 = '性別を選択してください';
        if ($sex === '') $err_msg5 = '言語を選択してください';

        if ($name !== '' && $age !== '' && $age >= '20' && $sex !== '' && $language !== '') {
            // データベースに登録
            $query_person = "INSERT INTO person_tb ("
                    ."name, "
                    ."age, "
                    ."sex, "
                    ."language"
                    .") VALUES ("
                    ."'" . mysqli_real_escape_string($link_person, $name) . "', "
                    . mysqli_real_escape_string($link_person, $age) . ", "
                    . mysqli_real_escape_string($link_person, $sex) . ", "
                    ."'" . mysqli_real_escape_string($link_person, $language) . "'"
                    .")";
            $res_person = mysqli_query($link_person, $query_person);

            if ($res_person !== false) {
                $msg = '登録に成功しました';

                // 画像投稿処理
                $tmp_image = $_FILES['image'];
                if ($tmp_image['error'] === 0 && $tmp_image['size'] !== 0) {
                    if (is_uploaded_file($tmp_image['tmp_name']) === true) {
                        $image_info = getimagesize($tmp_image['tmp_name']);
                        $image_mime = $image_info['mime'];
                        if ($tmp_image['size'] > 1048576) {
                            $img_err_msg1 = 'アップロードできる画像のサイズは、1MBまでです';
                        } elseif (preg_match('/^image\/jpeg$/', $image_mime) === 0) {
                            $img_err_msg2 = 'アップロードできる画像の形式は、JPEG形式だけです';
                        } elseif (move_uploaded_file($tmp_image['tmp_name'], './upload_' . time() . '.jpg') === true) {
                            $img_msg = ' 画像のアップロードも成功しました';
                        }
                    }
                }
            } else {
                $err_msg0 = '登録に失敗しました';
            }
        } else {
            $err_msg0 = '登録に失敗しました';
        }
    }

} else {
    echo 'データベースの接続に失敗しました';
}
mysqli_close($link_person);

echo '<table border = "1px">';
echo '<tr>';
echo '<th>名前</th>';
echo '<th>年齢</th>';
echo '<th>使用言語</th>';
echo '</tr>';
foreach ($data_person as $line_person) {
    echo '<tr>';
    echo '<td>' . $line_person['name'] . '</td>';
    echo '<td>' . $line_person['age'] . '</td>';
    echo '<td>' . $line_person['language'] . '</td>';
    echo '</tr>';
}
echo '</table>';

echo '<br>';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        名前<input type="text" name="name" value="<?php if ($msg === '') echo $name; ?>"><?php echo $err_msg1; ?><br>
        年齢<input type="number" name="age" value="<?php if ($msg === '') echo $age; ?>"><?php echo $err_msg2; echo $err_msg3 ?><br>
        画像<input type="file" name="image"><?php echo $img_err_msg1; echo $img_err_msg2; ?><br>
        性別<input type="radio" name="sex" value="0" <?php if ($msg === '' && $sex === "0") echo "checked"; ?>>男性
        &emsp;<input type="radio" name="sex" value="1" <?php if ($msg === '' && $sex === "1") echo "checked"; ?>>女性
        &emsp;<?php echo $err_msg4 ?><br>
        使用言語
        <select name="language">
            <option disabled selected>言語を選択してください</option>
            <option value="C/C++" <?php if ($msg === '' && $language === "C/C++") echo "selected"; ?>>C/C++</option>
            <option value="Java" <?php if ($msg === '' && $language === "Java") echo "selected"; ?>>Java</option>
            <option value="C#" <?php if ($msg === '' && $language === "C#") echo "selected"; ?>>C#</option>
            <option value="PHP" <?php if ($msg === '' && $language === "PHP") echo "selected"; ?>>PHP</option>
            <option value="Perl" <?php if ($msg === '' && $language === "Perl") echo "selected"; ?>>Perl</option>
            <option value="Ruby" <?php if ($msg === '' && $language === "Ruby") echo "selected"; ?>>Ruby</option>
        </select><?php echo $err_msg5 ?><br>
        <input type="submit" name="send" value="登録">
        <?php echo $msg; echo $err_msg0; echo $img_msg; ?>
    </form>
</body>
</html>

<?php
// 4-1
$db_host_store = 'localhost';
$db_name_store = 'store_db';
$db_user_store = 'root';
$db_pass_store = 'root';

$link_store1 = mysqli_connect($db_host_store, $db_user_store, $db_pass_store, $db_name_store);
if ($link_store1 !== false) {
    $query_store1 = "
    SELECT CT.customer_name, ODT.order_id, PT.product_name, PT.price,
    ODT.product_count, PT.price * ODT.product_count AS price×product_count
    FROM customer_tb AS CT
    JOIN order_tb AS OT
    ON CT.customer_id = OT.customer_id
    JOIN order_detail_tb AS ODT
    ON OT.order_id = ODT.order_id
    JOIN product_tb AS PT
    ON ODT.product_id = PT.product_id
    ORDER BY CT.customer_id, OT.order_id, PT.product_id";
    $res_store1 = mysqli_query($link_store1, $query_store1);
    $data_store1 = [];
    while ($row_store1 = mysqli_fetch_assoc($res_store1)) {
        $data_store1[] = $row_store1;
    }
} else {
    echo 'データベースの接続に失敗しました';
}
mysqli_close($link_store1);

echo '<table border = "1px">';
echo '<tr>';
echo '<th>顧客名</th>';
echo '<th>注文id</th>';
echo '<th>商品名</th>';
echo '<th>商品金額</th>';
echo '<th>商品数</th>';
echo '<th>商品金額×商品数</th>';
echo '</tr>';
foreach ($data_store1 as $line_store1) {
    echo '<tr>';
    echo '<td>' . $line_store1['customer_name'] . '</td>';
    echo '<td>' . $line_store1['order_id'] . '</td>';
    echo '<td>' . $line_store1['product_name'] . '</td>';
    echo '<td>' . $line_store1['price'] . '</td>';
    echo '<td>' . $line_store1['product_count'] . '</td>';
    echo '<td>' . $line_store1['price×product_count'] . '</td>';
    echo '</tr>';
}
echo '</table>';

echo '<br>';

// 4-2
$link_store2 = mysqli_connect($db_host_store, $db_user_store, $db_pass_store, $db_name_store);
if ($link_store2 !== false) {
    $query_store2 = "
    SELECT CT.customer_name, SUM(PT.price * ODT.product_count) AS sales_by_customer
    FROM customer_tb AS CT
    JOIN order_tb AS OT
    ON CT.customer_id = OT.customer_id
    JOIN order_detail_tb AS ODT
    ON OT.order_id = ODT.order_id
    JOIN product_tb AS PT
    ON ODT.product_id = PT.product_id
    GROUP BY CT.customer_name
    ORDER BY sales_by_customer DESC";
    $res_store2 = mysqli_query($link_store2, $query_store2);
    $data_store2 = [];
    while ($row_store2 = mysqli_fetch_assoc($res_store2)) {
        $data_store2[] = $row_store2;
    }
} else {
    echo 'データベースの接続に失敗しました';
}
mysqli_close($link_store2);

echo '<table border = "1px">';
echo '<tr>';
echo '<th>顧客名</th>';
echo '<th>売上</th>';
echo '</tr>';
foreach ($data_store2 as $line_store2) {
    echo '<tr>';
    echo '<td>' . $line_store2['customer_name'] . '</td>';
    echo '<td>' . $line_store2['sales_by_customer'] . '</td>';
    echo '</tr>';
}
echo '</table>';

echo '<br>';

// 5
// CREATE DATABASE counter_db default character SET utf8;

// create table counter_tb (
//   id int(11) unsigned not null auto_increment primary key,
//   counter int(11)
// );

$db_host_counter = 'localhost';
$db_name_counter = 'counter_db';
$db_user_counter = 'root';
$db_pass_counter = 'root';

$link_counter = mysqli_connect($db_host_counter, $db_user_counter, $db_pass_counter, $db_name_counter);
if ($link_counter !== false) {
    $query_counter_select = "SELECT * FROM counter_tb WHERE id = 1";
    $res_counter = mysqli_query($link_counter, $query_counter_select);
    $row_counter = mysqli_fetch_assoc($res_counter);
    if (isset($row_counter) !== true) {
        $query_counter_insert = "INSERT INTO counter_tb (id, counter) VALUES (1, 1);";
        $res_counter_insert = mysqli_query($link_counter, $query_counter_insert);
        $count = 1;
    } else {
        $count = $row_counter['counter'];
        $count ++;
        $query_counter_update = "UPDATE counter_tb SET counter = " . $count . " WHERE id = 1";
        $res_counter_update = mysqli_query($link_counter, $query_counter_update);
    }
} else {
    echo 'データベースの接続に失敗しました';
}
mysqli_close($link_counter);
echo 'count:' . $count;

?>
