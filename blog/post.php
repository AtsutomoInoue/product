<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';

//初期化
$error = $title = $content = '';

//データベースの接続
try{
  $pdo = new PDO(blog_db, blog_user, blog_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}

if(@$_POST['submit']){
  $title = $_POST['title'];
  $content = $_POST['content'];
  //空欄があった、もしくはタイトルが長い場合の処理
  if(!$title) $error .= 'タイトルが記入されていません。<br>';
  if(mb_strlen($title) > 88) $error .= 'タイトルが長すぎます。<br>';
  if(!$content) $error .= '本文がありません。<br>';
  //データベースに挿入する
  if(!$error){
    $sql = "INSERT INTO post(title,content,time)
     VALUES('$title','$content',CURRENT_TIME())";
    $st = $pdo->query($sql);
    header('Location: index.php');
    exit();
  }
}
require 't_post.php';
?>
