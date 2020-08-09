<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';
//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

//ARRAY定義の変数
$error_m = array();

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
 }
 session_start();

//ログインしているかどうかの確認
$logined_flag = false;
if(!isset($ignore_login)){
  if(isset($_SESSION["admin_id"])){
    $session_user_id = $_SESSION["admin_id"];
    try{
      $stmt = $pdo->prepare("SELECT * FROM user_admin WHERE admin_id = ? LIMIT 1");
      $stmt->execute(array($session_user_id));
      $row_user = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row_user){
        $logined_flag = true;
      }
    }catch(PDOException $e){
      exit("ログイン失敗。");
    }
  }
  //ログインしていない場合、ログインページに移す
  if(!$logined_flag){
    header('location: http://'.$_SERVER['HTTP_HOST'].'/product/school/admin/admin_login.php', true, 302);
    exit;
  }
}
//ショートカット関数
function he($str){
  return htmlentities($str, ENT_QUOTES, "UTF-8");
}
//ホワイトリストによる変数抽出
function whitelist($list){
  $request = array();
  foreach($list as $word){
    $request[$word] = null;
    if(isset($_REQUEST[$word])){
      $word = str_replace("\0","", $word);
      $request[$word] = $_REQUEST[$word];
    }
  }
  return $request;
}
?>