<?php

namespace root\User\Start_page;

require_once dirname(__FILE__) . '/../../Bootstrap.class.php';

use root\Bootstrap;
use root\PDODatabase;
use root\Session;
//use root\Common;

$ses = new Bootstrap();
$ses = new Session($db);

$loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, [
'cache' => Bootstrap::CACHE_DIR
]);

$template = $twig->load('User\Home.html.twig');
$template->display($context);
