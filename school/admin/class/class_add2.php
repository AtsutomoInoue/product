<?php
require_once (dirname(__FILE__).'/../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}

//ページフラグを立てて表示内容を振り分けする
$page_flag = 0; 
$c_name = $_POST["c_name"];
$error_m = array();

$c_name = htmlspecialchars($c_name, ENT_QUOTES, 'UTF-8');

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}

 //空欄があった場合の処理
if(empty($_POST['c_name'])){
  $error_m[] = 'クラス名を入力して下さい。';
}

//登録ボタンを押すとテーブルに追加する
try{
  if(!empty($_POST['submit'])){ 
    $page_flag = 1;
    //エスケープ処理
    $c_name = htmlspecialchars($_POST["c_name"], ENT_QUOTES, "UTF-8");
    $stmt = $pdo->prepare("INSERT INTO class(c_name) VALUES(?)");
    $stmt->execute([$c_name]);
    $_SESSION['success'] = '・クラス情報を下記項目にて追加しました。';
  }
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　クラス情報追加</title>
</head>
<body>
<h1>クラス情報追加</h1>
<hr>
<!-- 登録を押した時の動作 -->
<?php if ($page_flag === 1 && !empty($_SESSION['success'])): ?>
    <?php echo $_SESSION['success']; ?></p>
    <p>クラス名：<?php echo $c_name; ?></p>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php endif; ?>
<!-- 登録情報の確認の動作 -->
<?php if ($page_flag === 0): ?>
<?php if(!empty($_POST['c_name'])):?>
下記内容で追加します。宜しいですか？<br>
<form method="post" >
<p>クラス名：<?php echo $c_name; ?></p>
<input type="hidden" name="c_name" value="<?=$c_name?>">
<input type="submit" name="submit" value="登録"><br>
</form>
<?php else: ?>
 <?php foreach($error_m as $er) echo $er; ?>
<?php endif;?>
<hr>
<a href="index.php">戻る</a>
<?php endif; ?>
</body>
</html>