<?php
/*
ファイルパス　/Applications/MAMP/htdocs/DT/member/master/initMaster.class.php
ファイル名 initMaster.class.php
*/

namespace member\master;

class initMaster
{
    public static function getDate()
    {
        $yearArr = [];
        $monthArr = [];
        $dayArr = [];

        $next_year = date('Y') + 1;

        //年を作成
        //sprint関数　:指定された変数$iの値を「%04d」フォーマットで文字列化します。
        //%04dフォーマットは、整数値を4桁の0埋めで表現するためのフォーマットです。例えば、1は0001、12は0012、123は0123、1000は1000のように表示されます。
        for ($i = 1900; $i < $next_year; $i ++) {
            $year = sprintf("%04d", $i);
            $yearArr[$year] = $year . '年';
        }

        //月を作成
        for ($i = 1; $i < 13; $i ++) {
            $month = sprintf("%02d", $i);
            $monthArr[$month] = $month . '月';
        }

        //日を作成
        for ($i = 1; $i < 32; $i ++) {
            $day = sprintf("%02d", $i);
            $dayArr[$day] = $day . '日';
        }

        return [$yearArr, $monthArr, $dayArr];
    }

    public static function getSex()
    {
        $sexArr = ['1' => '男性', '2' => '女性'];
        return $sexArr;
    }

    public static function getTrafficWay()
    {
        $trafficArr = ['徒歩', '自転車', 'バス', '電車', '車・バイク'];
        return $trafficArr;
    }
}
