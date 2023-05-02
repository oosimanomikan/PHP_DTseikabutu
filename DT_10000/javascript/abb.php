<?php

  //定義方法その1
  $start_month = 6;
  $last_month = 8;

  for($i = $start_month; $i <= $last_month; $i++)
  {
    $arrMonth[] = $i . '月';
  }

  $arrShop = [
    'A',
    'B'
  ];

  $arrCol = [
    'product_count',
    'sales'
  ];

 
  $arrShopSales = [];

  foreach($arrMonth as $month) //質問
  {
    foreach($arrShop as $shop)
    {
      foreach($arrCol as $col)
      {
        $arrShopSales[$month][$shop][$col] = 0;
      }
    }
  }
  // echo '<pre>';
  // var_dump($arrShopSales);
  // echo '</pre>';

  $file = new SplFileObject('sales.csv');
  $file->setFlags(SplFileObject::READ_CSV);

  $arrShopSales = [];

  foreach($file as $res)
  {
    if($res[0] === null) continue;
    $month = $res[0];
    $shop = $res[1];

    getInitArr($month, $shop, $arrShopSales);

    $arrShopSales[$month][$shop]['product_count'] += $res [2];
    $arrShopSales[$month][$shop]['sales'] += $res[3];
  }

  // 定義2でソートした場合は以下の方法で

  // sortMonthAndShop($arrShopSales);
  // {
  //   ksort($arrShopSales);
  //   foreach($arrShopSales as $month => &$shopSales)
  //   {
  //     ksort($shopSales);
  //   }
  // }

  //定義方法その2
  function getInitArr($month, $shop, &$arrShopSales)
  {
    if(isset($arrShopSales[$month][$shop]) === false)
    {
      $arrShopSales[$month][$shop]['product_count'] = 0;
      $arrShopSales[$month][$shop]['sales'] = 0;
    }
  }

  //データを一次元で定義する場合はこちら
  // $arrShopSales = array();
  // foreach($arrMonth as $month)
  // {
  //   foreach($arrShop as $shop)
  //   {
  //     $shopSale = [
  //       'month' => $month,
  //       'shop' => $shop
  //     ];

  //     foreach($arrCol as $col)
  //     {
  //       $shopSale[$col] = 0;
  //     }
  //     $arrShopSales[] = $shopSale;
  //   }
  // }
  // $file = new SplFileObject('sales.csv');
  // $file->setFlags(SplFileObject::READ_CSV);

  // foreach($file as $res)
  // {
  //   if($res[0] === null) continue;
  //   $month = $res[0];
  //   $place = $res[1];

  //   foreach($arrShopSales as $index => $shopSale)
  //   {
  //     //月と店舗で合致するものを取得
  //     if($month === $shopSale['month'] && $place === $shopSale['shop'])
  //     {
  //       $arrShopSales[$index]['product_count'] += $res[2];
  //       $arrShopSales[$index]['sales'] += $res[3];

  //     }
  //   }
  // }  
?>

<table border="1px">
  <tr>
    <th>月</th>
    <th>商品数</th>
    <th>個数</th>
    <th>売り上げ</th>
    <?php foreach($arrShopSales as $month => $shopSaleData): ?>
      <tr>
        <td rowspan="<?= count($shopSaleData); ?>"><?= $month; ?></td>
        <?php foreach($shopSaleData as $shop => $sale): ?>
          <td><?= $shop; ?></td>
          <td><?= $sale['product_count']; ?></td>
          <td><?= $sale['sales']; ?></td>
      </tr>
      <?php endforeach; ?>
  </tr>
  <?php endforeach; ?>
</table>