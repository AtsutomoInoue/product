<?php
require_once (dirname(__FILE__).'/../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
  session_start();
}

try{//
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }

 if(!empty($_POST['submit'])){ //POST送信から投稿した場合の動作です。

  if(empty($_POST['k_name'])){ //空欄があった場合の動作及びサニタイズ処理を記載してます。
    $error_m[] = '名前を入力して下さい。';
  }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　科目情報追加</title>
</head>
<body>
<h1>科目情報追加</h1>
<hr>
<?php if(!empty($_POST['submit'])): ?>
     <?php if(empty($_POST['k_name'])): ?>
     <?php foreach ($error_m as $value): ?>
     <li><?php echo $value; ?></li>
     <?php endforeach; ?>
   </ul>
 <?php endif; ?>
     <?php endif; ?>
<form method="post" action="kamoku_add2.php">
<p>科目名：<input type="text" name="k_name"></p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>