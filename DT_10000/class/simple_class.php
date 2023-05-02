<?php
/* 
 * ファイルパス (Win): C:\xampp\htdocs\DT\classs\simple_class.php 
 * URL (Win): http://localhost/DT/class/simple_class.php
 */


//  ----- 1:最もシンプルなクラス -----

class Character
{
}

// インスタンス化
// クラスの定義がインスタンス化の先でも後でもエラーは出ない
$simple_character = new Character();

// 中身確認
// var_dump($simple_character);
// exit;


//  ----- 2:変数を持つクラス -----

// メモ帳も使って考えると分かりやすいかも！
class PropertyCharacter
{
  // クラス内の変数はプロパティ(メンバー変数)という
  // publicはアクセス修飾子といいます(詳細は「8:アクセス修飾子」にて後述)
  public $first_name;
  public $last_name;
}

$property_character_1 = new PropertyCharacter();
// プロパティの設定
$property_character_1->last_name = 'PHP';
$property_character_1->first_name = '太郎';

$property_character_2 = new PropertyCharacter();
$property_character_2->last_name = 'JavaScript';
$property_character_2->first_name = '花子';

// プロパティの参照
// インスタンス化されたオブジェクトはそれぞれ独立した実体を持ちます。変数の値が別物である点に注目してください

echo '名前は'.$property_character_1->last_name.$property_character_1->first_name.'<br>';
echo '名前は'.$property_character_2->last_name.$property_character_2->first_name.'<br>';

echo '<br><br>';


//  ----- 3:関数を持つクラス -----

// 下記の共通の処理をクラスに持たせよう！
// echo '名前は'.$property_character_1->last_name.$property_character_1->first_name.'<br>';

class MethodCharacter
{
  public $first_name;
  public $last_name;

  // クラス内で定義された関数はメソッド(メンバー関数)という
  public function self_introduction()
  {
    // $thisはインスタンスメソッドの中でのみ利用できる特別な変数
    // 現在のインスタンス(オブジェクト)を指す。
    // つまり「$this->last_name」はこのクラスの中にある「$last_name」を指す
    echo '名前は'.$this->last_name.$this->first_name.'メソッドキャラクラスから表示<br>';
  }
}

$method_character_1 = new MethodCharacter();
$method_character_1->last_name = 'PHP';
$method_character_1->first_name = '太郎';

$method_character_2 = new MethodCharacter();
$method_character_2->last_name = 'JavaScript';
$method_character_2->first_name = '花子';

$method_character_1->self_introduction();
$method_character_2->self_introduction();

echo '<br><br>';


//  ----- 4:コンストラクターを持つクラス -----

// 下記の共通の処理をクラスに持たせよう
// $method_character_1->last_name = 'PHP';
// $method_character_1->first_name = '太郎';

class ConstructCharacter
{
  public $first_name;
  public $last_name;

  // インスタンス化のタイミングで実行される特別なメソッドをコンストラクターという
  // 一般的にプロパティの初期化に使用される
  // 引数の名前はプロパティに合わせなくてもいい($last_nameや$first_nameでなくてもいい)
  public function __construct($last_name,$first_name)
  {
    // 左辺の「$this->last_name」はこのクラスの中にある「public $last_name」を指す
    // 右辺の「$last_name」は__construct()の第一引数の「$last_name」を指す
    $this->last_name = $last_name;
    $this->first_name = $first_name;
  }

  public function self_introduction()
  {
    echo '名前は'.$this->last_name.$this->first_name.':コンストラクターキャラクラスから表示<br>';
  }
}

// インスタンス化時に渡す引数は、クラスのコンストラクターの引数として使用される
$construct_character_1 = new ConstructCharacter('PHP', '太郎');
$construct_character_2 = new ConstructCharacter('JavaScript', '花子');

$construct_character_1->self_introduction();
$construct_character_2->self_introduction();

echo '<br><br>';


//  ----- 5:静的メソッド -----

class Exchanging {
  // インスタンスを生成しなくても、クラスから直接呼び出せるメソッド(静的メソッド)
  // さっきまで登場したメソッドはインスタンスメソッドともいう
  // static をつけると静的メソッドになります

  public static function convertYenIntoDollars($yen)
  {
    $rate = 0.0091;
    return floatval($rate * $yen);
  }
}

$money = 10000;
echo 'You have'.Exchanging::convertYenIntoDollars($money).' dollars';

echo '<br><br>';

// 捕捉:静的プロパティはシングルトンパターンで用いられる
// ゲームのセーブデータ管理クラスなど
// 一旦は「使い道」ではなく、「使い方」を覚えてください


//  ----- 6:静的プロパティ -----

// クラスから直接呼び出せる変数です
class ExchangingWithStaticProperty {
  // 静的メソッドでインスタンスプロパティは呼び出せない(インスタンス化していないので)
  // つまり$thisを使ってプロパティを呼び出せない
  // 代わりに静的プロパティは呼び出せる
  // 呼び出すときは「self::$プロパティ名」
  public $self_test = 'self';
  public static $rate = 0.0091;
  public static function convertYenIntoDollars($yen)
  {
    // $thisはエラーが出る
    // $this->self_test = 'test';
    return floatval(self::$rate * $yen);
  }
}

$money = 10000;
// 普通に静的メソッドで呼び出し
echo '1:You have '.ExchangingWithStaticProperty::convertYenIntoDollars($money).' dollars<br>';

// 外部から静的プロパティを変更出来る(アクセス修飾子がpublicの場合)
// 変更してから静的メソッドで呼び出し
ExchangingWithStaticProperty::$rate = 0.01;
echo '2:You have '.ExchangingWithStaticProperty::convertYenIntoDollars($money).' dollars<br>';

// インスタンス化して変更してから、静的プロパティで呼び出し
$exchanging_with_static_property = new ExchangingWithStaticProperty();
$exchanging_with_static_property::$rate = 0.1;
echo '3:You have '.ExchangingWithStaticProperty::convertYenIntoDollars($money).' dollars<br>';

echo '<br><br>';


// ソースコードに無いのでインプット講座では紹介しな!!!!
//  ----- 7:クラス定数 -----

class ExchangingWithConstant {
  public const RATE = 0.0091;
  public static function convertYenIntoDollars($yen)
  {
    return floatval(self::RATE * $yen);
  }
}

$money = 10000;
echo 'You have '.ExchangingWithConstant::convertYenIntoDollars($money).' dollars.<br>';

// 定数なのでアクセス修飾子がpublicでも変更出来ない
// ExchangingWithConstant::RATE = 0.01;
echo 'Rate is '.ExchangingWithConstant::RATE.'.<br>';

echo '<br><br>';


// この説明が終わったら、一旦ソースコードにもどってdreamTheaterクラスの説明!
//  ----- 8:アクセス修飾子 -----

// -- アクセス修飾子は3種類あります --
// public:どこからでもアクセス出来る
// protected:現在のクラスとサブクラス(後述9:クラスの継承とprotected)からのみアクセス出来る
// private:現在のクラスの中でのみアクセス出来る
// ※定数とメソッドのアクセスアクセス修飾子は省略するとpublicが暗黙的につけられる

class Dog {
  // privateプロパティは、クラスの外部からアクセス出来ない!
  private $name;

  public function __construct($name)
  {
    $this->name = $name;
  }
  // privateメソッドも、クラスの外部からアクセス出来ない
  private function getNameMessage() {
    return "ペットの名前は".$this->name."です<br>";
  }

  public function echoDogName() {
    $message = $this->getNameMessage();
    echo $message;
  }
}

// この説明が終わったら、一旦ソースコードにもどってdreamTheaterクラスの説明!
$name = "ホネスキー";
$my_dog = new Dog($name);

$my_dog->echoDogName();
// privateだとエラーが出る
// echo $my_dog->name;
// $my_dog->getNameMessage();

echo '<br><br>';


//  ----- 9:クラスの継承とprotected -----

// クラスの継承とは、もともとあるクラスの機能を引き継ぎながら、新たな機能を追加する
// 下記の例では、超人が人間の持つ機能を引き継いで手間と無駄を省いている
// ・人間と超人のクラスを全く別々に作った際、「両方を修正する必要が出たら手間が増える」
// =>人間が「食べる」メソッドを持ったら、超人も「食べる」メソッドを持たないといけないという場合が手間になる
// ・人間の持つ機能を超人も持っているなら、1から人間の機能を超人クラスに書くのも無駄になる

// 継承元となるクラスを親クラスという(スーパークラス、基底クラスともいう)
class NormalHuman {
  
  // 継承先のクラスと、このクラスが使用できる
  protected $name = '';

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function walk()
  {
    echo $this->name.' は歩きました<br>';
  }

  // 継承先のクラスと、このクラスが使用出来る
  protected function sneeze() {
    echo $this->name.' は「ハクション」とくしゃみをしました。<br>';
  }

  public function greet() {
    echo $this->name.' は「こんにちは」と言いました。<br>';
  }
}

// 継承の結果生まれたクラスを子クラスという(サブクラス、派生クラスともいう)
// 継承する際には extends と継承する親クラスの名前を書きます
class SuperHuman extends NormalHuman {
  public function __construct($name) 
  {
    // 親クラスのコンストラクターを使用して変数の初期化が出来る
    parent::__construct($name);
  }

  // 独自のメソッドを作成出来る
  public function superWalk()
  {
    echo $this->name.' は"マッハ5"で歩きました<br>';
  }

  public function superGreet($is_good_condition) {
    if($is_good_condition) {
      $this->greet();
    } else {
      // 親クラスのメソッドを使用することが出来る
      parent::sneeze();
      // $thisでも使用できるが、parentのほうが親クラスのメソッドだと分かりやすい
      // $this->sneeze();
      echo '声が大きすぎて、窓が割れました<br>';
    }
  }
}

$normal_human_name = 'ボブさん';
$normal_human = new NormalHuman($normal_human_name);
$normal_human->walk();
$normal_human->greet();
// protectedなのでエラーがでる
// $normal_human->sneeze();

$super_human_name = 'パトリックさん';
$super_human = new SuperHuman($super_human_name);
$super_human->superWalk();
$super_human->greet();
$is_good_condition = false;
$super_human->superGreet($is_good_condition);


?>