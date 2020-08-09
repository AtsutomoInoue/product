<?php
require_once (dirname(__FILE__).'../../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
  session_start();
}
$id = null;
//前ページから取得したid情報をint値にキャストする
if(!empty($_GET['id']) && empty($_POST['id'])){
  $id = (int)htmlspecialchars($_GET['id'],ENT_QUOTES);

  //データベースに接続、SQL文を発行
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM teacher WHERE id = ?";
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
 
//コースのドロップダウン
$stmt1 = $pdo->query("SELECT * from kamoku");
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

//クラスのドロップダウン
$stmt2 = $pdo->query("SELECT * from class");
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　教師情報編集</title>
</head>
<body>
<h1>教師情報編集</h1>
<hr>
<form method="post" action="teacher_edit2.php">
<p>番号：<input type="text" name="id" value="<?php echo $message["id"];?>" readonly></p>
<p>氏名：<input type="text" name="t_name" value="<?php if(!empty($message['t_name'])){echo $message['t_name'];} ?>"></p>
<p>担当科目：
  <select name="kamoku">
    <?php 
    foreach($result1 as $value1): ?>
      <option value="<?php echo $value1["id"]; ?>">
      <?php echo $value1["id"]; ?>:<?php echo $value1["k_name"];?></option>
    <?php endforeach ?>
  </select>
</p>
<p>担当クラス：
  <select name="class">
      <option value=""></option>
    <?php foreach($result2 as $value2):?>
      <option value="<?php echo $value2["class_id"];?>">
      <?php echo $value2["class_id"];?>:<?php echo $value2["c_name"]; ?></option>
      <?php endforeach ?>
  </select>
</p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">教師情報管理ページへ戻る</a>
</body>
</html>