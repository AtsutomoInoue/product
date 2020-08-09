<html>
<head>
<meta charset="utf-8">
<title>BLog</title>
<link rel="stylesheet" href="css/blog.css">
</head>
<body>
<h1>Blog test</h1>
<br>
<p>特段</p>
 <p class="post_link">
   <a href="post.php">新規投稿</a>
 </p>
 <br>
 <!-- 投稿した情報をindex.phpから取得する -->
<?php foreach ($posts as $post) { ?>
  <div class="post">
    <h2><?php echo $post['title'] ?></h2>
    <p><?php echo nl2br($post['content']) ?></p>
    <?php foreach ($post['comments'] as $comment) { ?>
      <div class="comment">
        <h3><?php echo $comment['name'] ?></h3>
        <p><?php echo nl2br($comment['content']) ?></p>
      </div>
    <?php } ?>
    <p class="comment_link">
      投稿日：<?php echo $post['time'] ?>
      <a href="comment.php?no=<?php echo $post['no'] ?>">コメント</a>
    </p>
  </div>
<?php } ?>
<a href="../index.php">トップページへ戻る</a>
</body>
</html>
