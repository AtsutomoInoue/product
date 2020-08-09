<html>
<head>
<meta charset="utf-8">
<title>コメント投稿 | BLog</title>
<link rel="stylesheet" href="css/blog.css">
</head>
<body>
<form method="post" action="comment.php">
  <div class="post">
    <h1>コメント投稿</h1>
    <p>投稿へのコメントを入力します。</p>
    <p>お名前</p>
    <p><input type="text" name="name" size="40" value="<?php echo $name ?>"></p>
    <p>コメント</p>
    <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
    <p>
      <input type="hidden" name="post_no" value="<?php echo $post_no ?>">
      <input name="submit" type="submit" value="投稿">
    </p>
    <p><?php echo $error ?></p>
  </div>
  <p><a href="index.php">コメントせずに戻る</a></p>
</form>
</body>
</html>
