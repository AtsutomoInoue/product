<?php
require_once (dirname(__FILE__).'../../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
  session_start();
}
$id = null;
if(!empty($_GET['id']) && empty($_POST['id'])){
  $id = (int)htmlspecialchars($_GET['id'],ENT_QUOTES);

  //データベースからテーブルデータを取得
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM teacher WHERE admin_id = ?";
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
}

//コースの情報
$stmt2 = $pdo->query("SELECT * from kamoku WHERE id");
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

//クラスの情報
$stmt3 = $pdo->query("SELECT * from class WHERE class_id");
$result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　教師情報削除</title>
</head>
<body>
<h1>教師情報削除</h1>
<hr>
下記内容で変更します。宜しいですか？<br>
<form method="post" action="teacher_del2.php">
<p>番号：<?php echo $message["id"];?></p>
<p>氏名：<?php if(!empty($message['t_name'])){echo $message['t_name'];} ?></p>
<p>担当科目：<?php if(!empty($message['k_id'])){echo $message['k_id'];} ?>:
  <?php foreach($result2 as $value2): ?>
  <?php if($message['k_id'] === $value2['id']){echo $value2["k_name"];}?>
  <?php endforeach ?></p>
<p>担当クラス：<?php if(!empty($message['tantou'])){echo $message['tantou'];} ?>:
  <?php foreach($result3 as $value3):?>
  <?php if($message['tantou'] === $value3['class_id']){echo $value3["c_name"];} ?>
  <?php endforeach ?></p>
    <input type="hidden" name="id" value="<?=$message["id"]?>">
<input type="submit" value="削除">
</form>
<hr>
<a href="index.php">教師情報管理ページへ戻る</a>
</body>
</html>