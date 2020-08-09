<?php
require_once (dirname(__FILE__).'../../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}
//ページフラグを立てて表示内容を振り分け
$page_flag = 0;

$t_name = $_POST["t_name"];
$kamoku = $_POST["kamoku"];
$class  = $_POST["class"];
$error_m = array();

$t_name = htmlspecialchars($t_name, ENT_QUOTES, 'UTF-8');

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }
 //コースの名前を表示する
 $stmt1 = $pdo->query("SELECT * from kamoku WHERE id = $_POST[kamoku]");
 $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

 //クラスの名前を表示する
 if(!empty($_POST["class"])){
 $stmt2 = $pdo->query("SELECT * from class WHERE class_id = $_POST[class]");
 $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
 }

//空欄があった場合の処理
 if(empty($_POST['t_name'])){ 
  $error_m[] = '名前を入力して下さい。';
}
 
//登録ボタンを押すとテーブルに追加する
try{
  if(!empty($_POST['submit'])){ 
  $page_flag = 1;
  $t_name = htmlspecialchars($_POST["t_name"], ENT_QUOTES, "UTF-8");
  //担当クラスの値が入っていた場合はtantouカラムも挿入する
    if(!empty($class)){
      $stmt = $pdo->prepare("INSERT INTO teacher(t_name,k_id,tantou) VALUES(?, ?, ?)");
      $stmt->execute([$_POST['t_name'], $kamoku, $class]);
    //担当クラスの値が空の場合は氏名と担当科目を挿入する
    }elseif(empty($class)){
      $stmt = $pdo->prepare("INSERT INTO teacher(t_name,k_id) VALUES(?, ?)");
      $stmt->execute([$_POST['t_name'], $kamoku]);
    }
    $_SESSION['success'] = '・生徒情報を下記項目にて編集しました。';
  }
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　教師情報追加</title>
</head>
<body>
<h1>教師情報追加</h1>
<hr>
<!-- 登録を押した時の動作 -->
<?php if ($page_flag === 1 && !empty($_SESSION['success'])): ?>
  <?php echo $_SESSION['success']; ?></p>
  <p>氏名：<?php echo $t_name; ?></p>
  <p>担当科目：<?php echo $_POST["kamoku"].'　'; ?>
  <?php foreach($result1 as $val1) echo $val1['k_name']; ?></p>
    <p>担当クラス：
    <?php if(!empty($class)):?>
      <?php echo $_POST["class"].'　'; ?>
      <?php foreach($result2 as $val2) echo $val2['c_name']; ?></p>
    <?php endif; ?>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php endif; ?>

<!-- 登録情報の確認の動作 -->
<?php if ($page_flag === 0): ?>
<?php if(!empty($_POST['t_name'])):?>
下記内容で追加します。宜しいですか？<br>
<form method="post" >
<p>氏名：<?php echo $t_name; ?></p>
<p>担当科目：<?php echo $kamoku.'　'; ?>
<?php foreach($result1 as $val1) { echo $val1['k_name']; } ?></p>
<p>担当クラス：<?php if(!empty($class)):?>
<?php echo $class.'　'; ?>
<?php foreach($result2 as $val2) { echo $val2['c_name']; } ?>
<?php endif; ?></p>
  <input type="hidden" name="t_name" value="<?=$t_name?>">
  <input type="hidden" name="kamoku" value="<?=$kamoku?>">
  <input type="hidden" name="class" value="<?=$class?>">
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