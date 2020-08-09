<?php
require_once (dirname(__FILE__).'/../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
session_start();
}
//前ページから取得したid情報をint値にキャストする
$id = null;
if(!empty($_GET['id']) && empty($_POST['id'])){
  $id = (int)htmlspecialchars($_GET['id'],ENT_QUOTES);
  
  //データベースに接続、SQL文を発行
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT * FROM user_admin WHERE admin_id = ?";
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

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　ユーザー情報削除</title>
</head>
<body>
<h1>ユーザー情報削除</h1>
<hr>
下記内容を削除します。宜しいですか？<br>
<form method="post" action="user_del2.php">
<p>ID：<?php echo $message["admin_id"];?></p>
<p>ユーザー名：<?php if(!empty($message['admin_user'])){echo $message['admin_user'];} ?></p>
<p>権限：<?php if(!empty($message['kanri'])){echo $message['kanri'];} ?></p>
<input type="hidden" name="admin_id" value="<?=$message["admin_id"]?>">
<input type="submit" value="削除">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>