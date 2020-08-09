<?php
require_once (dirname(__FILE__).'/../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}
//ページフラグを立てて表示内容を振り分ける
$page_flag = 0;

$k_name = $_POST["k_name"];
$error_m = array();

//エスケープ処理
$k_name = htmlspecialchars($k_name, ENT_QUOTES, 'UTF-8');

//データベースへ接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}

//空欄があった場合の処理
if(empty($_POST['k_name'])){
  $error_m[] = '科目名を入力して下さい。';
}

//登録ボタンを押すとテーブルに追加する
try{
  if(!empty($_POST['submit'])){ 
    $page_flag = 1;
    //エスケープ処理
    $k_name = htmlspecialchars($_POST["k_name"], ENT_QUOTES, "UTF-8");
    $stmt = $pdo->prepare("INSERT INTO kamoku(k_name) VALUES(?)");
    $stmt->execute([$k_name]);
    $_SESSION['success'] = '・科目情報を下記項目にて追加しました。';
  }
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　科目情報追加</title>
</head>
<body>
<h1>科目情報追加</h1>
<hr>
<!-- 登録を押した時の動作 -->
<?php if ($page_flag === 1 && !empty($_SESSION['success'])):?>
  <?php echo $_SESSION['success']; ?></p>
  <p>科目名：<?php echo $k_name; ?></p>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php endif;?>
<!-- 登録情報の確認の動作 -->
<?php if ($page_flag === 0): ?>
<?php if(!empty($_POST['k_name'])):?>
下記内容で追加します。宜しいですか？<br>
<form method="post" >
<p>科目名：<?php echo $k_name; ?></p>
<input type="hidden" name="k_name" value="<?=$k_name?>">
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