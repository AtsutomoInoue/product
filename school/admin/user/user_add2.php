<?php
require_once (dirname(__FILE__).'../../admin_common.php');

if(!isset($_SESSION)){
  session_start();
}
//ページフラグを立てて表示内容を振り分ける
$page_flag = 0;

$user = $_POST["admin_user"];
$pass = $_POST["admin_pass"];
$kanri = $_POST['kanri'];
$kanrinum = intval($_POST['kanri']);
$date = date("Y-m-d H:i:s");
$kanrimsg = array();
$user = htmlspecialchars($user, ENT_QUOTES,'UTF-8');

//管理権限でチェックボックスから渡されたデータの表示に使う
if(!empty($kanri)){
  $kanrimsg[] = 'あり';
}else{
  $kanrimsg[] = 'なし';
}
//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }
 //空欄があった場合の動作とサニタイズ処理
 if(empty($_POST['admin_user'])){
  $error_m[] = '・ユーザー名を入力して下さい。';
}
if(!preg_match("/^[a-zA-Z0-9_-]+$/", $user)){
  $error_m[] = '・ユーザー名は英数字のみで入力してください。';
}
 if(empty($_POST['admin_pass'])){
   $error_m[] = '・パスワードを入力して下さい。';
 }

//登録ボタンを押すとテーブルに追加
try{
if(!empty($_POST['submit'])){ 
 $page_flag = 1;
 $stmt = $pdo->prepare("INSERT INTO user_admin(admin_user,admin_pass,admin_update,admin_create, kanri) VALUES(?, ?, ?, ?, ?)");
 $stmt->execute([$user, password_hash($pass, PASSWORD_DEFAULT), $date, $date, $kanri]);
 $_SESSION['success'] = '・ユーザー情報を追加しました。';
  }
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　ユーザー情報追加</title>
</head>
<body>
<h1>ユーザー情報追加</h1>
<hr>
<!-- 登録を押した時の動作 -->
<?php if ($page_flag === 1 && !empty($_SESSION['success'])):?>
  <?php echo $_SESSION['success']; ?></p>
  <p>ユーザー名：<?php echo $_POST["admin_user"]; ?></p>
  <p>管理権限：
  <?php foreach($kanrimsg as $kanri_m) echo $kanri_m; ?></p>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php endif;?>
<!-- 登録情報の確認の動作 -->
<?php if ($page_flag === 0): ?>
<?php if(!empty($user) && preg_match("/^[a-zA-Z0-9_-]+$/", $user) && !empty($pass)):?>
下記内容で追加します。宜しいですか？<br>
<form method="post" >
<p>ユーザー名：<?php echo $user; ?></p>
<p>管理権限：<?php foreach($kanrimsg as $kanri_m) echo $kanri_m; ?></p>
  <input type="hidden" name="admin_user" value="<?=$user?>">
  <input type="hidden" name="admin_pass" value="<?=$pass?>">
  <input type="hidden" name="kanri" value="<?=$kanrinum?>">
<input type="submit" name="submit" value="登録"><br>
</form>
<?php else: ?>
 <?php foreach($error_m as $er) echo $er.'<br>'; ?>
<?php endif;?>
<hr>
<a href="index.php">戻る</a>
<?php endif; ?>
</body>
</html>