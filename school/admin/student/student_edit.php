<?php
require_once (dirname(__FILE__).'/../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
session_start();
}

$id = null;
//前ページから取得したid情報をint値にキャストする
if(!empty($_GET['id']) && empty($_POST['id'])){
  $id = (int)htmlspecialchars($_GET['id'],ENT_QUOTES);
//データベースに接続し、SELECT文を発行する
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM student WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));
    if($stmt){
      $message = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
      header("Location:./index.php");
    }
  }catch(PDOException $e){
    echo "Connection failed.".$e->getMessage().'\n';
    exit();
   }
}elseif(!empty($_POST['id'])){
  $id = (int)htmlspecialchars($_POST['id'],ENT_QUOTES);
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
<title>学園管理　生徒情報編集</title>
</head>
<body>
<h1>生徒情報編集</h1>
<hr>
<form method="post" action="student_edit2.php">
<p>学籍番号：<input type="text" name="id" value="<?php echo $message["id"];?>" readonly></p>
<p>氏名：<input type="text" name="s_name" value="<?php if(!empty($message['s_name'])){echo $message['s_name'];} ?>"></p>
<p>コース：
  <select name="course">
    <?php 
    //コースをドロップダウン形式で選択し、選択したIDをname属性で送信する
    foreach($result2 as $value2): ?>
      <option value="<?php echo $value2["course_id"]; ?>">
      <?php echo $value2["course_id"]; ?>:<?php echo $value2["course_name"];?></option>
    <?php endforeach ?>
  </select>
</p>
<p>クラス：
  <select name="class">
    <?php
    //クラスもコースと同様にドロップダウン形式で選択し、選択したIDをname属性で送信する
    foreach($result3 as $value3):?>
      <option value="<?php echo $value3["class_id"];?>">
      <?php echo $value3["class_id"];?>:<?php echo $value3["c_name"]; ?></option>
      <?php endforeach ?>
  </select>
</p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>