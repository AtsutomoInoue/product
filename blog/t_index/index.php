<?php
//データベースを接続して投稿情報を取得する。
$pdo = new PDO("mysql:dbname=blog", "testuser","testuser");
  $st = $pdo->query("SELECT * FROM post ORDER BY no DESC");
  $posts = $st->fetchAll(); //変数stから取得したSQLをfetchAllで返す。
  for ($i = 0; $i < count($posts); $i++) {
    /*for文の間にpostテーブルのIDと一致していたコメントをcommentテーブルから取得する。*/
    $st = $pdo->query("SELECT * FROM comment WHERE post_no={$posts[$i]['no']} ORDER BY no DESC");
    $posts[$i]['comments'] = $st->fetchAll();
  }
  require 't_index.php';//t_index.phpを呼び出して表示させている。

?>
