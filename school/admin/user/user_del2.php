<?php
require_once (dirname(__FILE__).'/../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}

//送信されたidをintvalでint値に変換し、$id変数に格納
$id = intval($_POST['admin_id']);

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }

//テーブルから削除
try{
 $stmt = $pdo->prepare("DELETE FROM user_admin WHERE admin_id = :id");
 $stmt->execute(array(':id'=>$id));
 $_SESSION['success'] = '・ユーザー情報を削除しました。';
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　ユーザー情報削除</title>
</head>
<body>
<h1>ユーザー情報削除</h1>
<hr>
<?php if(!empty($_SESSION['success'])) echo $_SESSION['success']; ?></p>
<hr>
<a href="index.php">戻る</a>
</body>
</html>