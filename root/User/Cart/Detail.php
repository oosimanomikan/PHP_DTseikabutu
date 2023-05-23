<?php
    // 商品詳細を表示するプログラム、Controller
    
    namespace root\User\Cart;

    require_once dirname(__FILE__) . '/Bootstrap.class.php';
    
    use root\Bootstrap;
    use root\PDODatabase;
    use root\Session;
    use root\Item;
    
    $db = new PDODatabase(
        Bootstrap::DB_HOST,
        Bootstrap::DB_USER,
        Bootstrap::DB_PASS,
        Bootstrap::DB_NAME,
        Bootstrap::DB_TYPE
    );

    $ses = new Session($db);
    $itm = new Item($db);
    
    // テンプレート指定
    $loader = new \Twig\Loader\FilesystemLoader(Bootstrap::TEMPLATE_DIR);
    $twig = new \Twig\Environment($loader, [
    'cache' => Bootstrap::CACHE_DIR
    ]);

    // セッションに、セッションIDを設定する
    $ses->checkSession();
    
    // item_idを取得する
    $item_id = (isset($_GET['item_id']) === true && preg_match('/^\d+$/', $_GET['item_id']) === 1) ? $_GET['item_id'] : '';
    
    // item_idが取得できていない場合、商品一覧へ遷移させる
    if ($item_id === '') {
        header('Location: ' . Bootstrap::ENTRY_URL. 'list.php');
    }
    // カテゴリーリスト(一覧)を取得する
    $cateArr = $itm->getCategoryList();
    
    // 商品情報を取得する
    $itemData = $itm->getItemDetailData($item_id);
    $context = [];
    $context['cateArr'] = $cateArr;
    $context['itemData'] = $itemData[0];// なぜ０が必要かは、$itemDataをvar_dumpしてみよう！
    $template = $twig->load('Detail.html.twig');
    $template->display($context);
?>