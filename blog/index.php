<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';

//データベースに接続
try{
  $pdo = new PDO(blog_db, blog_user, blog_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}
  //投稿内容を抽出する
  $sql = "SELECT * FROM post ORDER BY no DESC";
  $st = $pdo->query($sql);
  $posts = $st->fetchAll(PDO::FETCH_ASSOC); //変数stから取得したSQLをfetchAllで返す。
  for ($i = 0; $i < count($posts); $i++) {
    //for文の間にpostテーブルのIDと一致していたコメントをcommentテーブルから取得する。
    $sql = "SELECT * FROM comment ";
    $sql .= "WHERE post_no={$posts[$i]['no']} ORDER BY no ASC";
    $st = $pdo->query($sql);
    $posts[$i]['comments'] = $st->fetchAll(PDO::FETCH_ASSOC);
  }
?>
<html>
<head>
<meta charset="utf-8">
<title>Blog</title>
<link rel="stylesheet" href="css/blog.css">
</head>
<body>
<h1>Blog test</h1>
<br>
<p>コメント返信機能を備えたブログです</p>
 <p class="post_link">
   <a href="post.php">新規投稿する</a>
 </p>
 <br>
 <!-- 投稿した情報をindex.phpから取得する -->
<?php foreach ($posts as $post) { ?>
  <div class="post">
    <h2><?php echo $post['title'] ?></h2>
    <p><?php echo nl2br($post['content']) ?></p>
    <p class="comment_link">
      投稿日：<?php echo $post['time'] ?>
      <a href="comment.php?no=<?php echo $post['no'] ?>">コメント</a>
    </p>
    <?php foreach ($post['comments'] as $comment) { ?>
      <div class="comment">
        <h3><?php echo $comment['name'] ?></h3>
        <p><?php echo nl2br($comment['content']) ?></p>
      </div>
    <?php } ?>
    
  </div>
<?php } ?>
<a href="../index.php">トップページへ戻る</a>
</body>
</html>
