<?php
//接続情報を定義したファイルを使用
require_once('db_define.php');
//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

$errors = array();
$rows = array();

//空入力の場合、名前を入力してくださいと出力する
if(empty($_POST)){
  header("Location: search.php");
  exit();
}else{
  if(!isset($_POST['s_name']) || $_POST['s_name'] === ""){
    $errors['s_name'] = "名前を入力してください。";
  }
}

//文字が入力されていた場合、search.htmlから送られてきた文字を元にSQLを実行
//LIKEを使い、任意の文字がある事を条件に表示させる
if(count($errors) === 0){
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $statement = $pdo->prepare("SELECT student.id,s_name,course.course_name,class.c_name FROM student LEFT JOIN class on student.class_id = class.class_id LEFT JOIN course on student.course_id = course.course_id WHERE s_name LIKE (:name)");
  if($statement){
    $s_name = $_POST['s_name'];
    $like_name = "%".$s_name."%";
    $statement->bindValue(':name',$like_name, PDO::PARAM_STR);

    if($statement->execute()){
      $row_count = $statement->rowCount();

      while($row = $statement->fetch()){
        $rows[] = $row;
      }
    }else{
      $errors['error'] = "検索失敗しました。";
      }
    $pdo = null;
    }
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  
 }
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>検索</title>
</head>
<body>
  <p>検索</p>
  <br>
  〇×学園高等学校所属の生徒の情報を検索します。<br>
  <hr>
  <?php if(count($errors) === 0): ?>
  <p>検索結果　<?=$row_count?>件</p>
  <table border ="2">
  <tr>
  <th>学籍番号</th><th>氏名</th><th>コース</th><th>クラス</th>
  </tr>
  <?php
  foreach($rows as $row){
    echo '<tr><td>'.$row['id'].'</td><td>'.$row['s_name'].'</td><td>'.$row['course_name'].'</td><td>'.$row['c_name'].'</td></tr>';
  }
  ?>
  </table>

  <?php elseif(count($errors) > 0):?>
  <?php foreach($errors as $value){
    echo "<p>".$value."</p>";
  }
  ?>

<?php endif; ?>
  <hr>
  <p>
  <form action="search.php" method="post">
    名前：<input type="text" name="s_name"><br>
    <input type="submit" value="検索">
  </form></p>
  <p><a href="index.php">戻る</a></p>
</body>
</html>