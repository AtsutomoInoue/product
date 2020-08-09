<?php
require_once (dirname(__FILE__).'../../admin_common.php');

if(!isset($_SESSION)){
session_start();
}

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->prepare("SELECT * FROM user_admin ORDER BY admin_id ASC");
  $stmt->execute($pdo);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }

$admin_u = htmlspecialchars($_SESSION['admin_user'],ENT_QUOTES,'UTF-8');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　パスワード変更</title>
</head>
<body>
<h1>パスワード変更</h1>
<hr>
<form method="post" action="user_pass2.php">
ユーザー名：<input type="text" name="admin_user" value="<?php echo $admin_u?>"><br>

新パスワード：<input type="password" name="new_pass" value=""><br>
確認用：<input type="password" name="new_pass_chk" value=""><br>
<input type="submit" value="変更"><br>
</form>
<hr>
<a href="setting.php">戻る</a>
</body>
</html>