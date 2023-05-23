<?php
namespace root\User\Cart;
class Items
    {
        public $cateArr = [];
        public $db = null;

        public function __construct($db)
        {
            $this->db = $db;
        }

        // カテゴリーリストの取得
        public function getCategoryList()
        {
            $table = ' categories ';
            $col = ' id, name ';
            $res = $this->db->select($table, $col);
            return $res;
        }

        // 商品リストを取得する
        public function getItemList($id)
        {
            // カテゴリーによって表示させるアイテムをかえる
            $table = ' items ';
            $col = ' id, name, detail, price,quantity,image_name,gender,category_id ';
            $where = ($id !== '') ? ' id = ? ' : '';
            $arrVal = ($id !== '') ? [$id] : [];
            
            $res = $this->db->select($table, $col, $where, $arrVal);
            
            return ($res !== false && count($res) !== 0) ? $res : false;
        }

        // 商品の詳細情報を取得する
        public function getItemDetailData($id)
        {
            $table = ' items ';
            $col = ' id, name, detail, price,quantity,image_name,gender,category_id ';
            $where = ($id !== '') ? ' id = ? ' : '';
            
            // カテゴリーによって表示させるアイテムをかえる
            $arrVal = ($id !== '') ? [$id] : [];
            
            $res = $this->db->select($table, $col, $where, $arrVal);
            
            return ($res !== false && count($res) !== 0) ? $res : false;
        }
    }
?>  