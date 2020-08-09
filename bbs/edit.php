<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';

//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

//投稿IDを振り分けに使う変数です。
$id = null;

try{//データベースからテーブルデータを取得します。
  $pdo = new PDO(bbs_db, bbs_user, bbs_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}

session_start();
//管理者としてログインしているか確認します。
if(empty($_SESSION['admin_login'])|| $_SESSION['admin_login'] !== true){
  header("Location: ./admin.php"); //ログインページへ転送します。
}
if(!empty($_GET['id']) && empty($_POST['id'])){
  $id = (int)htmlspecialchars($_GET['id'],ENT_QUOTES);
//データベースからテーブルデータを取得します。
  try{
    $pdo = new PDO(db_name, user, pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = $pdo->query("SELECT * FROM board WHERE id = $id");
    if($result){
      $message = $result->fetch(PDO::FETCH_ASSOC);
    }else{
      header("Location:./admin.php");
    }
  }catch(PDOException $e){
    echo "Connection failed.".$e->getMessage().'\n';
    exit();
   }
}elseif(!empty($_POST['id'])){
  $id = (int)htmlspecialchars($_POST['id'],ENT_QUOTES);
//サニタイズ処理を行います。
  if(empty($_POST['name'])){
    $error_m[] = '名前を入力し下さい。';
  }else{
    $message['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $message['name'] = preg_replace( '/\\r\\n|\\n|\\r/', '', $message['name']);
  }

  if(empty($_POST['comment'])){
    $error_m[] = 'メッセージを入力し下さい。';
  }else{
    $message['comment'] = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
  }

  if(empty($error_m)){ //更新処理をデータベースから行います。
      try{
        $pdo = new PDO(db_name, user, pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("UPDATE board SET name=:name, comment=:comment WHERE board.id = :id");
        $stmt->execute(array(':name'=>$message['name'],':comment'=>$message['comment'],':id'=>$id));
      }catch(Exception $e){ //例外が発生した場合の動作です。
        echo "Connection failed.".$e->getMessage().'\n';
        exit();
      }
      if($stmt){
        header("Location:./admin.php");
      }
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>一言掲示板</title>
<link rel="stylesheet" href="css/bbs.css">
</head>
<body>
 <h1>一言掲示板 投稿の編集</h1>
  <?php if(!empty($error_m)): ?>
   <ul class="error_m">
     <?php foreach ($error_m as $value): ?>
       <li><?php echo $value; ?></li>
     <?php endforeach; ?>
   </ul>
 <?php endif; ?>
 <p>一言掲示板の編集ページです。</p>
<form method="post"><!-- 内容を入力する項目です。POST送信を使います。 -->
  <div>
    <label for="view_name">名前</label>
    <input id="view_name" type="text" name="name" value="<?php if(!empty($message['name'])){echo $message['name'];} ?>">
  </div>
  <div>
    <label for="message">本文</label>
    <textarea id="message" name="comment" rows="8" cols="80">
<?php if(!empty($message['comment'])){echo $message['comment'];}?></textarea>
  <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
  </div>
  <a class="cansel" href="admin.php">キャンセル</a>
  <input type="submit" name="submit" value="更新">
</form>
</body>
</html>
