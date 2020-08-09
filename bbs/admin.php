<?php
//ログインパスワード定義
define( 'PASSWORD', 'admin');

//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';
//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

require_once('../paging.php');

//ARRAY定義の変数を置きます。
$message = array();
$success_m = array();
$error_m = array();
//セッションに保存します。
session_start();

if(!empty($_POST['submit'])){ //ログインパスワードが一致するかの動作です。
  if(!empty($_POST['admin_password']) && $_POST['admin_password'] === PASSWORD){
    $_SESSION['admin_login'] = true;
  }else{
    $error_m[] = 'パスワードが違います。';
  }
}

if(!empty($_GET['logout'])){
  unset($_SESSION['admin_login']);
  header('Location: ./admin.php');
}

try{//データベースからテーブルデータを取得します。
  $pdo = new PDO(bbs_db, bbs_user, bbs_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
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
<title>一言掲示板 管理ページ</title>
<link rel="stylesheet" href="css/bbs.css">
<link rel="stylesheet" href="../css/paging.css">
</head>
<body>
 <h1>一言掲示板 管理ページ</h1>
 <?php if(!empty($error_m)): ?>
   <ul class="error_m">
     <?php foreach ($error_m as $value): ?>
       <li><?php echo $value; ?></li>
     <?php endforeach; ?>
   </ul>
 <?php endif; ?>
 <p>一言掲示板の管理ページです。</p>
  <hr>
  <section>
    <!-- ログイン情報を入れないとSELECTから投入された投稿内容を表示されません。 -->
    <?php if(!empty($_SESSION['admin_login']) && $_SESSION['admin_login'] === true): ?>
      <form action="" method="get">
        <input type="submit" name="logout" value="ログアウト">
      </form>
      <?php echo $pageing -> html ?>
    <?php if(!empty($message_array)): ?>
      <?php foreach ($message_array as $value): ?>
        <article>
          <div class="info">
            <?php echo $value['name']; ?>
            <time><?php echo date('Y年m月d日 H:i',strtotime($value['time'])); ?></time>
              <a class="idou" href="edit.php?id=<?php echo $value['id']; ?>">編集</a>
              <a class="idou" href="delete.php?id=<?php echo $value['id']; ?>">削除</a>
          </div>
          <p><?php echo nl2br($value['comment']); ?></p>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  <?php  else: ?>
    <form method="post">
      <div>
        <label for="admin_password">ログインパスワード</label>
        <input type="password" id="admin_password" name="admin_password" value="">
      </div>
      <input type="submit"  name="submit" value="ログイン">
      <div class="back">
        <br>
        <a href="./index.php">掲示板へ戻る</a>
      </div>
    </form>
  <?php endif; ?>
  </section>
</form>
</body>
</html>
