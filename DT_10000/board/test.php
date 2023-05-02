<?php
require_once '/Applications/MAMP/htdocs/DT/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('/Applications/MAMP/htdocs/DT/templates/board');
$twig = new \Twig\Environment($loader, [
]);























$name = "PHP自己学習";
echo $twig->render('board5.html.twig', ['name' => $name]);
