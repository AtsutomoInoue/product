<?php
require_once (dirname(__FILE__).'../../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}

//ページフラグを立てて表示内容を振り分けする
$page_flag = 0; 

$user = $_POST["admin_user"];
$newpass = $_POST["new_pass"];
$newpasschk = $_POST['new_pass_chk'];
$date = date("Y-m-d H:i:s");
$id = $_SESSION["admin_id"];
$error_m = array();

$user = htmlspecialchars($user, ENT_QUOTES,'UTF-8');

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }
 
 $stmt = $pdo->prepare("SELECT * FROM user_admin WHERE admin_id = :id");
 $stmt->execute([':id'=>$id]);
 $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//空欄があった場合の処理
if(empty($_POST['admin_user'])){
  $error_m[] = '名前を入力して下さい。';
}
  if($newpass != $newpasschk){
  $error_m[] = '・パスワードが違います。';
}
  if(empty($newpass) || empty($newpasschk)){
  $error_m[] = '・パスワードを入れてください。';
}

//SQL文
try{
if(!empty($_POST['submit'])){ 
 $page_flag = 1;
 //エスケープ処理
 $auser = htmlspecialchars($_POST['admin_user'], ENT_QUOTES,'UTF-8');
 $stmt = $pdo->prepare("UPDATE user_admin SET admin_user=:admin_user, admin_pass=:admin_pass, admin_update=:updt WHERE admin_id=:id");
 $stmt->execute([':admin_user'=>$auser, ':admin_pass'=>password_hash($_POST['new_pass'], PASSWORD_DEFAULT), ':updt'=>$date, ':id'=>$id]);
  $_SESSION['success'] = '・パスワードを変更しました。';
  }
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　パスワード変更</title>
</head>
<body>
<h1>パスワード変更</h1>
<hr>
<!-- 登録を押した時の動作 -->
<?php if ($page_flag === 1 && !empty($_SESSION['success'])):?>
  <?php echo $_SESSION['success']; ?></p>
  <p>ユーザー名：<?php echo $_POST["admin_user"]; ?></p>
  <hr>
  <p><a href="setting.php">戻る</a></p>
<?php endif;?>
<!-- 登録情報の確認の動作 -->
<?php if ($page_flag === 0): ?>
  <?php if(!empty($_POST['admin_user']) && ($newpass == $newpasschk)): ?>
  <?php if( !empty($newpass) && !empty($newpasschk)):?>
下記内容で追加します。宜しいですか？<br>
<form method="post" >
<p>ユーザー名：<?php echo $user; ?></p>
  <p><input type="hidden" name="admin_user" value="<?=$user?>"></p>
  <p><input type="hidden" name="new_pass" value="<?=$newpass?>"></p>
  <p><input type="hidden" name="new_pass_chk" value="<?=$newpasschk?>"></p>
<input type="submit" name="submit" value="登録"><br>
</form>
  <?php else: ?>
    <?php foreach($error_m as $er) echo $er.'<br>'; ?>
  <?php endif;?>
  <?php endif;?>
<hr>
<a href="setting.php">戻る</a>
 <?php endif;?>
</body>
</html>