<?php
//ログイン情報が無い場合にログインページに飛ばすよう読み込む
require_once "admin_common.php";
if(!isset($_SESSION)){
session_start();
}
//ページフラグを立てる
$page_flag = 0;

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }
 //管理権限が付与されているか判定する
 //user_adminテーブル内kanriカラムの値が1だったらフラグを1に変えて
 //表示できるようにする
if($_SESSION['kanri'] === 1){
  $page_flag = 1;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　設定ページ</title>
<link rel="stylesheet" href="css/bbs.css">
</head>
<body>
 <h1>学園管理 設定</h1>
<br>
 <p>設定です。</p>
  <hr>

  <section>
    <p><a href="user_pass.php">管理者パスワード変更</a></p>
    <?php if ($page_flag === 1):?>
    <p><a href="./user/index.php">管理者情報</a></p>    
    <?php endif;?>
    <hr>
    <p><a href="index.php">戻る</a></p>
  </section>
</form>
</body>
</html>
