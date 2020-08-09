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
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　クラス情報削除</title>
</head>
<body>
<h1>クラス情報削除</h1>
<hr>
下記内容で変更します。宜しいですか？<br>
<form method="post" action="class_del2.php">
<p>ID：<?php echo $message["class_id"];?></p>
<p>クラス名：<?php if(!empty($message['c_name'])){echo $message['c_name'];} ?></p>
<input type="hidden" name="class_id" value="<?=$message["class_id"]?>">
<input type="submit" value="削除">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>