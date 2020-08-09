<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';

//タイムゾーン
date_default_timezone_set('Asia/Tokyo');
//
require_once('../paging.php');

//ARRAY定義の変数を置きます。
$message = array();
$message_array = array();
$error_m = array();
$clean = array();
//セッションを開始しますが、このセッションはリロードによる多重投稿を防止する為に使います。
session_start();

//データベースの接続です
try{
  $pdo = new PDO(bbs_db, bbs_user, bbs_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){ //例外が発生した場合の動作です。
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}

if(!empty($_POST['submit'])){ //POST送信から投稿した場合の動作です。

  if(empty($_POST['name'])){ //空欄があった場合の動作及びサニタイズ処理を記載してます。
    $error_m[] = '名前を入力して下さい。';
  }else{
    $clean['name'] = htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
    $clean['name'] = preg_replace( '/\\r\\n|\\n|\\r/', '', $clean['name']);

  }
  if(empty($_POST['comment'])){
    $error_m[] = 'メッセージを入力し下さい。';
  }else{
    $clean['comment'] = htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
    $clean['comment'] = preg_replace( '/\\r\\n|\\n|\\r/','<br>', $clean['comment']);
  }
if(empty($error_m)){ //空欄が無かったらデータベースに接続し投稿します。
  try{
    //テーブルに投稿内容を挿入する。
    $stmt = $pdo->prepare("INSERT INTO board(name,comment) VALUES(?, ?)");
    $stmt->execute([$clean["name"], $clean["comment"]]);
    if($stmt){
      $_SESSION['success'] = '・メッセージを投稿しました。';
    }else{
      $error_m[] = '・投稿に失敗しました。';
    }
  }catch(PDOException $e){ //例外が発生した場合の動作です。
    echo "Connection failed.".$e->getMessage().'\n';
    exit();
  }
  header('Location: ./index.php');
 }
}

//1ページに表示させる数
$row_count = 7;
//テーブル全体の件数を取得
$sql = "SELECT COUNT(*) FROM board";
$sth = $pdo -> query($sql);
$count = $sth -> fetch(PDO::FETCH_COLUMN);

$page = 1;
if(isset($_GET['page']) && is_numeric($_GET['page'])){
  $page = (int)$_GET['page'];
}
if(!$page){
  $page = 1;
}

try{//データベースからテーブルデータを取得します。
 $sql = "SELECT * FROM board ORDER BY id DESC";
 $sql .= ", id LIMIT ".(($page - 1) * $row_count).", ".$row_count;
 $result = $pdo -> query($sql);
 $message_array = $result->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
 echo "Connection failed.".$e->getMessage().'\n';
 exit();
}

//Pagingクラスを生成、ページングのHTML部分を作成
$pageing = new Paging();
$pageing -> count = $row_count;
$pageing -> setHtml($count);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>一言掲示板</title>
<link rel="stylesheet" href="css/bbs.css">
<link rel="stylesheet" href="../css/paging.css">
</head>
<body>
 <h1>一言掲示板</h1>
 <!-- この行は投稿時に未入力エラーや投稿できた旨をを記述します。 -->
 <?php if(empty($_POST['submit']) && !empty($_SESSION['success'])): ?>
   <p class="success_message"><?php echo $_SESSION['success']; ?></p>
     <?php unset($_SESSION['success']); ?>
     <?php endif; ?>
     <?php if(!empty($error_m)): ?>
   <ul class="error_m">
     <?php foreach ($error_m as $value): ?>
     <li><?php echo $value; ?></li>
     <?php endforeach; ?>
   </ul>
 <?php endif; ?>
 <a href="./admin.php">管理ページへ</a>
 <p>一言掲示板です。名前、本文を入力し、投稿して下さい。</p>
 <a href="../index.php">トップページへ戻る</a>
<form method="post"><!-- 内容を入力する項目です。POST送信を使います。 -->
  <div>
    <label for="view_name">名前</label>
    <input id="view_name" type="text" name="name" value="">
  </div>
  <div>
    <label for="message">本文</label>
    <textarea id="message" name="comment" rows="8" cols="80"></textarea>
  </div>
  <input type="submit" name="submit" value="投稿">
  <hr>
  <!-- SELECTから投入された投稿内容を表示します。 -->
  <?php echo $pageing -> html ?>
  <section>
    <?php if(!empty($message_array)): ?>
      <?php foreach ($message_array as $value): ?>
        <article>
          <div class="info">
            名前：<?php echo $value['name']; ?>
            <time><?php echo date('Y年m月d日 H:i',strtotime($value['time'])); ?></time>
          </div>
          <p><?php echo $value['comment']; ?></p>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</form>
</body>
</html>
