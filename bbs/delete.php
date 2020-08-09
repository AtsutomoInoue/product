<?php
//接続定義を読み込む
require dirname(__FILE__).'../../db_define.php';
//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

//ARRAY定義の変数を置きます。
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

  try{//データベースからテーブルデータを取得します。
    $sql = "SELECT * FROM board WHERE id = $id";
    $result = $pdo->query($sql);
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

  try{
  $sql = "DELETE FROM board WHERE board.id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(':id'=>$id));
  }catch(Exception $e){ //例外が発生した場合の動作です。
    echo "Connection failed.".$e->getMessage().'\n';
    exit();
  }
  if($stmt){ //削除処理ができた場合、管理ページに移動します。
    header("Location:./admin.php");
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
 <h1>一言掲示板 投稿の削除</h1>
  <?php if(!empty($error_m)): ?>
   <ul class="error_m">
     <?php foreach ($error_m as $value): ?>
       <li><?php echo $value; ?></li>
     <?php endforeach; ?>
   </ul>
 <?php endif; ?>
 <p>一言掲示板の投稿削除ページです。</p>
 <p>下記内容を削除します。宜しければ「削除」ボタンをクリックして下さい。</p>
<form method="post"><!-- 内容を入力する項目です。POST送信を使います。 -->
  <div>
    <label for="view_name">名前</label>
    <input id="view_name" type="text" name="name" value="<?php if(!empty($message['name'])){echo $message['name'];} ?>" disabled>
  </div>
  <div>
    <!-- 入力欄にdisabledを記述することで入力しないようにしています。 -->
    <label for="message">本文</label>
    <textarea id="message" name="comment" rows="8" cols="80" disabled>
      <?php if(!empty($message['comment'])){echo $message['comment'];}?></textarea>
  　<input type="hidden" name="id" value="<?php echo $message['id']; ?>">
  </div>
  <button type="button" onclick="location.href='admin.php'">キャンセル</button>
  <input type="submit" name="submit" value="削除">
</form>
</body>
</html>
