<?php
require_once (dirname(__FILE__).'../../admin_common.php');
include_once(dirname(__FILE__).'../../../paging.php');

if(!isset($_SESSION)){
session_start();
}

try{//データベースの接続
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}

//1ページに表示させる数
$row_count = 5;
//テーブル全体の件数を取得
$sql = "SELECT COUNT(*) FROM student";
$sth = $pdo -> query($sql);
$count = $sth -> fetch(PDO::FETCH_COLUMN);

$page = 1;
if(isset($_GET['page']) && is_numeric($_GET['page'])){
  $page = (int)$_GET['page'];
}
if(!$page){
  $page = 1;
}

//テーブルデータを取得
//studentテーブルにcourseテーブルとclassテーブルを右外部結合し、
//其々のIDが一致を条件にコース名とクラス名を表示させる
$sql = "SELECT student.id,s_name,course.course_name,class.c_name FROM `student` LEFT JOIN class on student.class_id = class.class_id LEFT JOIN course on student.course_id = course.course_id";
$sql .= " ORDER BY student.id LIMIT ".(($page - 1) * $row_count).", ".$row_count;
$result = $pdo -> query($sql);
$stmt = $result->fetchAll(PDO::FETCH_ASSOC);

//Pagingクラスを生成、ページングのHTML部分を作成する
$pageing = new Paging();
$pageing -> count = $row_count;
$pageing -> setHtml($count);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<link rel="stylesheet" href="../../paging.css">
<title>学園管理　生徒情報管理ページ</title>
</head>
<body>
<h1>生徒情報 管理ページ</h1>
<hr>
<p><a href="student_add.php">生徒情報追加</a></p>
<hr>
<ul>
<table border ="2">
  <tr>
  <th></th><th>学籍番号</th><th>氏名</th><th>コース</th><th>クラス</th>
  </tr>
<?php if(!empty($stmt)): ?>
    <?php foreach ($stmt as $value): ?>
      <article>
      <tr><td><a href="student_edit.php?id=<?php echo $value['id']; ?>">生徒情報編集</a></td>
          <?php echo '<td>'.$value['id'].'</td>';
                echo '<td>'.$value['s_name'].'</td>';
                echo '<td>'.$value['course_name'].'</td>';
                echo '<td>'.$value['c_name'].'</td>';?>
        <td><a href="student_del.php?id=<?php echo $value['id']; ?>">生徒情報削除</a></td></tr>
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