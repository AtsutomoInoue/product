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

  //データベースに接続、SQL文を発行
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM class WHERE class_id = $id");
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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　クラス情報編集</title>
</head>
<body>
<h1>クラス情報編集</h1>
<hr>
<form method="post" action="class_edit2.php">
<p>ID：<input type="text" name="id" value="<?php echo $message["class_id"];?>" readonly></p>
<p>クラス名：<input type="text" name="c_name" value="<?php if(!empty($message['c_name'])){echo $message['c_name'];} ?>"></p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>