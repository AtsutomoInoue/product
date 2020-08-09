<?php
require_once (dirname(__FILE__).'../../admin_common.php');
include_once(dirname(__FILE__).'../../../paging.php');

if(!isset($_SESSION)){
  session_start();
}

//データベースに接続、SQL文を発行
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
$sql = "SELECT COUNT(*) FROM kamoku";
$sth = $pdo -> query($sql);
$count = $sth -> fetch(PDO::FETCH_COLUMN);

$page = 1;
if(isset($_GET['page']) && is_numeric($_GET['page'])){
  $page = (int)$_GET['page'];
}
if(!$page){
  $page = 1;
}

//テーブルデータの取得
$sql = "SELECT * FROM kamoku";
$sql .= " ORDER BY id LIMIT ".(($page - 1) * $row_count).", ".$row_count;
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
<title>学園管理　科目情報</title>
</head>
<body>
<h1>科目情報 管理ページ</h1>
<hr>
<p><a href="kamoku_add.php">科目情報追加</a></p>
<hr>
<ul>
<table border ="2">
  <tr>
  <th></th><th>ID</th><th>科目名</th>
  </tr>
<?php if(!empty($stmt)): ?>
    <?php foreach ($stmt as $value): ?>
      <article>
      <tr><td><a href="kamoku_edit.php?id=<?php echo $value['id']; ?>">科目編集</a></td>
          <?php echo '<td>'.$value['id'].'</td>';
                echo '<td>'.$value['k_name'].'</td>';?>
        <td><a href="kamoku_del.php?id=<?php echo $value['id']; ?>">削除</a></td></tr>
      </article>
    <?php endforeach; ?>
<?php endif; ?>
</table>
</ul>
<br>
<?php echo $pageing -> html ?>
<hr>
<a href="../index.php">管理ページへ戻る</a>
</body>
</html>