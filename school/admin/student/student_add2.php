<?php
require_once (dirname(__FILE__).'/../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}
//ページフラグを立てて表示内容を振り分けする
$page_flag = 0; 

$s_name = $_POST["s_name"];
$course = $_POST["course"];
$class  = $_POST["class"];
$error_m = array();

$s_name = htmlspecialchars($s_name, ENT_QUOTES, 'UTF-8');

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}

//コースの名前を表示
$stmt1 = $pdo->query("SELECT * from course WHERE course_id = $_POST[course]");
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

//クラスの名前を表示
$stmt2 = $pdo->query("SELECT * from class WHERE class_id = $_POST[class]");
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

//空欄があった場合の処理
if(empty($_POST['s_name'])){ 
  $error_m[] = '名前を入力して下さい。';
}

//登録ボタンを押すと$page_flagを1にしてテーブルに追加
try{
  if(!empty($_POST['submit'])){ 
    $page_flag = 1;
    $s_name = htmlspecialchars($_POST["s_name"], ENT_QUOTES, "UTF-8");
    $stmt = $pdo->prepare("INSERT INTO student(s_name,course_id,class_id) VALUES(?, ?, ?)");
    $stmt->execute([$s_name, $course, $class]);
    $_SESSION['success'] = '・生徒情報を下記項目にて追加しました。';
    }
  }catch(PDOException $e){
    echo "Connection failed. ".$e->getMessage().'\n';
    exit();
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　生徒情報追加</title>
</head>
<body>
<h1>生徒情報追加</h1>
<hr>

<!-- 登録を押した時の動作 -->
<?php if ($page_flag === 1 && !empty($_SESSION['success'])): ?>
  <!-- セッション変数をechoで呼び出し -->
  <?php echo $_SESSION['success']; ?></p>
  <!-- POSTで送信した内容をechoで呼び出し -->
  <p>氏名：<?php echo $s_name; ?></p>
  <p>コース：<?php echo $_POST["course"]; ?>　
    <?php foreach($result1 as $val1) echo $val1['course_name']; ?></p>
  <p>クラス：<?php echo $_POST["class"]; ?>　
    <?php foreach($result2 as $val2) echo $val2['c_name']; ?></p>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php endif; ?>

<!-- 登録情報の確認の動作 -->
<?php if ($page_flag === 0): ?>
<?php if(!empty($_POST['s_name'])):?>
下記内容で追加します。宜しいですか？<br>
<form method="post" >
<p>氏名：<?php echo $s_name; ?></p>
<p>コース：<?php echo $course; ?>　
<?php foreach($result1 as $val1) echo $val1['course_name']; ?></p>
<p>クラス：<?php echo $class; ?>　
<?php foreach($result2 as $val2) echo $val2['c_name']; ?></p>
<!-- hiddenを使い、入力内容を自身へ送信 -->
  <input type="hidden" name="s_name" value="<?=$s_name?>">
  <input type="hidden" name="course" value="<?=$course?>">
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