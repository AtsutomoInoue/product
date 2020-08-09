<?php
require_once (dirname(__FILE__).'../../admin_common.php');
include_once(dirname(__FILE__).'../../../paging.php');

if(!isset($_SESSION)){
  session_start();
}

//kanriカラムの値が0だったら遷移させる
if($_SESSION['kanri'] === 0){
  header("Location: ../setting.php");
}

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}
 
//1ページに表示させる数
$row_count = 5;

//テーブル全体の件数を取得
$sql = "SELECT COUNT(*) FROM user_admin";
$sth = $pdo -> query($sql);
$count = $sth -> fetch(PDO::FETCH_COLUMN);

$page = 1;
if(isset($_GET['page']) && is_numeric($_GET['page'])){
  $page = (int)$_GET['page'];
}
if(!$page){
  $page = 1;
}

//テーブルを取得
$sql = "SELECT admin_id,admin_user,kanri FROM `user_admin` ";
$sql .= " ORDER BY admin_id LIMIT ".(($page - 1) * $row_count).", ".$row_count;
$result = $pdo -> query($sql);
$stmt = $result->fetchAll(PDO::FETCH_ASSOC);
 
//Pagingクラスを生成、ページングのHTML部分を作成
$pageing = new Paging();
$pageing -> count = $row_count;
$pageing -> setHtml($count);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<link rel="stylesheet" href="../../paging.css">
<title>学園管理　ユーザー情報管理ページ</title>
</head>
<body>
<h1>ユーザー情報 管理ページ</h1>
<hr>
<p><a href="user_add.php">ユーザー追加</a></p>
<hr>
<table border ="2">
  <tr>
  <th></th><th>ID</th><th>ユーザー名</th><th>管理権限</th>
  </tr>
<?php if(!empty($stmt)): ?>
    <?php foreach ($stmt as $value): ?>
      <article>
      <tr><td><a href="user_edit.php?id=<?php echo $value['admin_id']; ?>">編集</a></td>
          <?php echo '<td>'.$value['admin_id'].'</td>';
                echo '<td>'.$value['admin_user'].'</td>';
                echo '<td>'.$value['kanri'].'</td>';?>
        <td><a href="user_del.php?id=<?php echo $value['admin_id']; ?>">削除</a></td></tr>
      </article>
    <?php endforeach; ?>
<?php endif; ?>
</table></p>
  </ul>
  <br>
  <?php echo $pageing -> html ?>
<hr>
<a href="../setting.php">管理ページへ戻る</a>
</body>
</html>