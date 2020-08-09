<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';

//初期化する
$post_no = $error = $name = $content = '';

//データベースの接続
try{
  $pdo = new PDO(blog_db, blog_user, blog_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}

if(@$_POST['submit']){
  $post_no = strip_tags($_POST['post_no']);
  $name = strip_tags($_POST['name']);
  $content = strip_tags($_POST['content']);
  //空欄があった場合、エラー文を出力
  if(!$name) $error .= '名前がありません。<br>';
  if(!$content) $error .= 'コメントがありません。<br>';
  //空欄が無ければデータベースに挿入する
  if(!$error){
    $sql = "INSERT INTO comment(post_no,name,content) VALUES(?,?,?)";
    $st = $pdo->prepare($sql);
    $st->execute(array($post_no,$name,$content));
    header('Location: index.php');
    exit();
  }
}else{
  $post_no = strip_tags($_GET['no']);
}
require 't_comment.php';
?>
