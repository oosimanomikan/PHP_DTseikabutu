<?php
session_start();

//require_once '../functions.php';
//require_once '../classes/UserLogic.php';

// $result = UserLogic::checkLogin();
// if($result) {
//   header('Location: mypage.php');
//   return;
// }
namespace public;

require_once dirname(__FILE__) . '/Bootstrap.class.php';

$loader = new \Twig_Loader_Filesystem(Bootstrap::TEMPLATE_DIR);
$twig = new \Twig_Environment($loader, [
     'cache' => Bootstrap::CACHE_DIR
]);

$template = $twig->load('signup_form.twig');
$template->display([]);

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);

if (isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
<?php endif; ?>

