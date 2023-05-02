<?php

$email = isset($_POST['email'])? htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8') : '';
$password = isset($_POST['password'])? htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'): '';

if ($email == '') {
    header("Location:./corporate-site/admin/index.twig");
    exit;
}
if ($password == '') {
    header("Location:./corporate-site/admin/index.twig");
    exit;
}

if ($email=='admin@admin.com'&&$password=='password01') {
+           session_start();
+           $_SESSION['admin_login'] = true;
    header("Location:./corporate-site/admin/dashboard.php");
} else {
    header("Location:./corporate-site/admin/index.twig");
    exit;
}