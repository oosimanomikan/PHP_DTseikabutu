<?php
    // 商品一覧を表示するプログラム、Controller

    namespace shopping;

    require_once dirname(__FILE__) . '/Bootstrap.class.php';

    use shopping\Bootstrap;
    use shopping\lib\PDODatabase;
    use shopping\lib\Session;
    use shopping\lib\Item;
    
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
    
    // SessionKeyを見て、DBへの登録状態をチェックする
    $ses->checkSession();
    $ctg_id = (isset($_GET['ctg_id']) === true && preg_match('/^[0-9]+$/', $_GET['ctg_id']) === 1) ? $_GET['ctg_id'] : '';
    
    // カテゴリーリスト(一覧)を取得する
    $cateArr = $itm->getCategoryList();
    
    // 商品リストを取得する
    $dataArr = $itm->getItemList($ctg_id);
    $context = [];
    $context['cateArr'] = $cateArr;
    $context['dataArr'] = $dataArr;
    $template = $twig->load('list.html.twig');
    $template->display($context);
?>