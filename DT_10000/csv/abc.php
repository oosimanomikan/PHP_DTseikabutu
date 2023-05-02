  <?php
    echo "大問１−２<br><br>";
    $file1 = new SplFileObject('test2.csv');
    $file1->setFlags(SplFileObject::READ_CSV);
    $sum6a = 0;
    $total6a = 0;
    $sum6b = 0;
    $total6b = 0;
    $sum7a = 0;
    $total7a = 0;
    $sum7b = 0;
    $total7b = 0;
    $sum8a = 0;
    $total8a = 0;
    $sum8b = 0;
    $total8b = 0;



    foreach ($file1 as $key) {
        var_dump($key);
        if ($key[0] === '６月' && $key[1] == 'A') {
            $int = intval($key[2]);
            $sum = intval($key[3]);
            $sum6a += $int;
            $total6a += $sum;
        } elseif ($key[0] === '６月' && $key[1] == 'B') {
            $int = intval($key[2]);
            $sum = intval($key[3]);
            $sum6b += $key[2];
            $total6b += $key[3];
        } elseif ($key[0] === '7月' && $key[1] == 'A') {
            $int = intval($key[2]);
            $sum = intval($key[3]);
            $sum7a += $key[2];
            $total7a += $key[3];
        } elseif ($key[0] === '7月' && $key[1] == 'B') {
            $int = intval($key[2]);
            $sum = intval($key[3]);
            $sum7b += $key[2];
            $total7b += $key[3];
        } elseif ($key[0] === '8月' && $key[1] == 'A') {
            $int = intval($key[2]);
            $sum = intval($key[3]);
            $sum8a += $key[2];
            $total8a += $key[3];
        } elseif ($key[0] === '8月' && $key[1] == 'B') {
            $int = intval($key[2]);
            $sum = intval($key[3]);
            $sum8b += $key[2];
            $total8b += $key[3];
        }
    }

    ?>
        <table border = "1px">
        <tr>
            <td>月</td>
            <td>店舗</td>
            <td>売上商品数</td>
            <td>売り上げ</td>
        </tr>
        
        <tr>
        <td>６月</td>

        <td>A</td>

        <td> <?php echo $sum6a ;?> </td>

        <td> <?php echo $total6a ?> 
        </tr>
    
   </table>