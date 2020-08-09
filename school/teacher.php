<?php
//接続情報を定義したファイルを使用
require_once('db_define.php');
//ページングファイルを読み込む
include_once('paging.php');
//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
 }
 //1ページに表示させる数
 $row_count = 5;
//テーブル全体の件数を取得
 $sql = "SELECT COUNT(*) FROM teacher";
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
 //teacherテーブルにkamokuテーブルとclassテーブルを右外部結合し、
 //其々のIDが一致を条件にコース名とクラス名を表示させる
 $sql = "SELECT teacher.id,t_name,kamoku.k_name,class.c_name FROM `teacher` LEFT JOIN kamoku on teacher.k_id = kamoku.id LEFT JOIN class on teacher.tantou = class.class_id";
 $sql .= " ORDER BY teacher.id LIMIT ".(($page - 1) * $row_count).", ".$row_count;
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
<title>教師一覧ページ</title>
</head>
<body>
  <p>教師情報</p>
  <br>
  〇×学園高等学校所属の教師の情報を表示します。<br>
  <hr>
  <p>
  <ul>
  <table border ="2">
  <tr>
  <th>教師番号</th><th>氏名</th><th>担当科目</th><th>担当クラス</th>
  </tr>
  <?php
  foreach($array as $row){
    echo '<tr><td>'.$row['id'].'</td><td>'.$row['t_name'].'</td><td>'.$row['k_name'].'</td><td>'.$row['c_name'].'</td></tr>';
  }
  ?>
  </table></p>
  </ul>
  <br>
  <?php echo $pageing -> html ?>
  <hr>
  <p><a href="index.php">戻る</a></p>
<?php
?>
</body>
</html>