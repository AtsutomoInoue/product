<?php
require_once (dirname(__FILE__).'../../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
session_start();
}

//変数をnull値に格納
$id = null;

//前ページから取得したid情報をint値にキャストする
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
    header("Location:./setting.php");
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
<title>学園管理　ユーザー情報編集</title>
</head>
<body>
<h1>ユーザー情報編集</h1>
<hr>
<form method="post" action="user_edit2.php">
<p>ID：<input type="text" name="id" value="<?php echo $message["admin_id"];?>" readonly></p>
<p>ユーザー名：<input type="text" name="admin_user" value="<?php if(!empty($message['admin_user'])){echo $message['admin_user'];} ?>"></p>
<p>パスワード：<input type="password" name="admin_pass"></p>
<p>管理権限：<input type="hidden" name="kanri" value="0">
<input type="checkbox" name="kanri" value="1"></p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>