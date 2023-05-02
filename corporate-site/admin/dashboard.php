<?php
   session_start();
   if($_SESSION['admin_login'] == false){
       header("Location:./corporate-site/admin/index.twig");
       exit;
   }
?>
