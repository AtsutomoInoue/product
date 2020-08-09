<?php

$ignore_login = true;
require_once "admin_common.php";
//ホワイトリストを利用
$whitelist = array("send", "admin_user", "admin_pass");
$request = whitelist($whitelist);

$page_e = "";

//入力されていない場合の動作
if(isset($request["send"])){
  if($request["admin_user"] == ""){
    $page_e .= "ユーザー名を入れてください。\n";
  }
  if($request["admin_pass"] == ""){
    $page_e .= "パスワードを入れてください。\n";
  }
}

//ログイン判定
if(isset($request["send"]) && $page_e == ""){
  try{
    $stmt = $pdo->prepare("SELECT * FROM user_admin WHERE admin_user = ? LIMIT 1");
    $stmt->execute(array($request["admin_user"]));
    $row_user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row_user){
      if(password_verify($request["admin_pass"],$row_user["admin_pass"])){
        $_SESSION["admin_id"] = $row_user["admin_id"];
        //ユーザー名を表示させるための処理
        $_SESSION["admin_user"] = $row_user["admin_user"];
        //権限情報の判定に使う
        $_SESSION["kanri"] = $row_user["kanri"];      
        header("Location: index.php");
        exit;
      }
    }
    $page_e .= "入力内容が違います\n";
  }catch(PDOException $e){
    echo "Connection failed.".$e->getMessage().'\n';
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>学園管理　管理ページ</title>
</head>
<body>
 <h1>学園管理 管理ページ</h1>

 <p>管理ページです。</p>
  <hr>
  <p class="attention">
    <?php echo nl2br(he($page_e)); ?>
  </p>
  <form action="" method="post">
      <div>
        ログイン名<br>
        <input type="text" name="admin_user" value="">
      </div>
      <div>
        パスワード<br>
        <input type="password" name="admin_pass" value="">
      </div>
      <input type="submit"  name="send" value="ログイン">
      <div class="back">
        <br>
        <a href="../index.php">戻る</a>
      </div>
    </form>
  
</form>
</body>
</html>
