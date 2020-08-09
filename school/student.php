<?php
//接続情報を定義したファイルを読み込む
require_once('db_define.php');
//ページングファイルを読み込む
include_once('paging.php');
//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

try{//データベースを接続します。
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
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
 $array = $result->fetchAll(PDO::FETCH_ASSOC);

 //Pagingクラスを生成、ページングのHTML部分を作成
 $pageing = new Paging();
 $pageing -> count = $row_count;
 $pageing -> setHtml($count);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<link rel="stylesheet" href="./paging.css">
<title>生徒一覧ページ</title>
</head>
<body>
  <p>生徒情報</p>
  <br>
  〇×学園高等学校所属の生徒の情報を表示します。<br>
  <hr>
  <p>
  <ul>
  <table border ="2">
  <tr>
  <th>学籍番号</th><th>氏名</th><th>コース</th><th>クラス</th>
  </tr>
  <?php foreach($array as $row): ?>
  <?php echo '<tr><td>'.$row['id'].'</td><td>'.$row['s_name'].'</td><td>'.$row['course_name'].'</td><td>'.$row['c_name'].'</td></tr>';?>
  <?php endforeach;  ?>
  </table></p>
  </ul>
  <?php echo $pageing -> html ?>
  <br>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php
?>
</body>
</html>