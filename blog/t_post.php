<html>
<head>
<meta charset="utf-8">
<title>記事投稿 | BLog</title>
<link rel="stylesheet" href="css/blog.css">
</head>
<body>
<form method="post" action="post.php">
  <div class="post">
    <h1>記事投稿</h1>
    <p>新規投稿します。投稿しない場合は投稿せずに戻るを選択してください。</p>
    <p>title</p>
    <p><input type="text" name="title" size="40" value="<?php echo $title ?>"></p>
    <p>本文</p>
    <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
    <p><input name="submit" type="submit" value="投稿"></p>
    <p><?php echo $error ?></p>
  </div>
  <p><a href="index.php">投稿せずに戻る</a></p>
</form>
</body>
</html>
