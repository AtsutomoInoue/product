<?php
//ログイン情報が無い場合にログインページに飛ばすよう読み込む
require_once "admin_common.php";

if(!isset($_SESSION)){
session_start();
}

//ログアウトの動作で、ユーザーIDをアンセットしてログインページに飛ばす
if(!empty($_GET['logout'])){
  unset($_SESSION['admin_id']);
  header("Location: admin_login.php");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　管理ページ</title>
<link rel="stylesheet" href="css/bbs.css">
</head>
<body>
 <h1>学園管理 管理ページ</h1>
<br>
 <p>ようこそ <?php echo htmlspecialchars($_SESSION['admin_user'],ENT_QUOTES,'UTF-8');?> さん</p>
  <hr>
  <section>
       <p><a href="student/index.php">生徒情報管理</a></p>
        <p><a href="teacher/index.php">教師情報管理</a></p>
        <p><a href="kamoku/index.php">科目管理</a></p>
        <p><a href="class/index.php">クラス管理</a></p>
        <p><a href="setting.php">設定へ</a></p>
        <hr>
        <form action="" method="get">
        <input type="submit" name="logout" value="ログアウト">
        </form>
      </div>
  </section>
</form>
</body>
</html>
