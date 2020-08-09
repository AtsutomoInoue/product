<?php
require_once (dirname(__FILE__).'/../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
  session_start();
}
$id = null;
if(!empty($_GET['id']) && empty($_POST['id'])){
  $id = (int)htmlspecialchars($_GET['id'],ENT_QUOTES);
//データベースからテーブルデータを取得します。
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM student WHERE id = $id");
    if($stmt){
      $message = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
      header("Location:./index.php");
    }
  }catch(PDOException $e){
    echo "Connection failed.".$e->getMessage().'\n';
    exit();
   }
}

//コースの情報
$stmt2 = $pdo->query("SELECT * from course WHERE course_id");
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

//クラスの情報
$stmt3 = $pdo->query("SELECT * from class WHERE class_id");
$result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　生徒情報削除</title>
</head>
<body>
<h1>生徒情報削除</h1>
<hr>
下記内容で変更します。宜しいですか？<br>
<form method="post" action="student_del2.php">
<p>学籍番号：<?php echo $message["id"];?></p>
<p>氏名：<?php if(!empty($message['s_name'])){echo $message['s_name'];} ?></p>
<p>コース：<?php if(!empty($message['course_id'])){echo $message['course_id'];} ?>:
  <?php foreach($result2 as $value2): ?>
  <?php if($message['course_id'] === $value2['course_id']){echo $value2["course_name"];}?>
  <?php endforeach ?></p>
<p>クラス：<?php if(!empty($message['class_id'])){echo $message['class_id'];} ?>:
  <?php foreach($result3 as $value3):?>
  <?php if($message['class_id'] === $value3['class_id']){echo $value3["c_name"];} ?>
  <?php endforeach ?></p>
    <input type="hidden" name="id" value="<?=$message["id"]?>">
<input type="submit" value="削除">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>