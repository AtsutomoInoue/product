<?php
require_once (dirname(__FILE__).'/../admin_common.php');
$error_m = array();

if(!isset($_SESSION)){
  session_start();
}

//データベースに接続
try{
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed. ".$e->getMessage().'\n';
  exit();
}
//コースのドロップダウン
$stmt1 = $pdo->query("SELECT * from course");
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

//クラスのドロップダウン
$stmt2 = $pdo->query("SELECT * from class");
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　生徒情報追加</title>
</head>
<body>
<h1>生徒情報追加</h1>
<hr>
<?php if(!empty($_POST['submit'])): ?>
     <?php if(empty($error_m)): ?>
     <?php foreach ($error_m as $value): ?>
     <li><?php echo $value; ?></li>
     <?php endforeach; ?>
   </ul>
 <?php endif; ?>
     <?php endif; ?>
<form method="post" action="student_add2.php">
<p>氏名：<input type="text" name="s_name"></p>
<p>コース：
  <select name="course">
    <?php
     //コースをドロップダウン形式で選択し、IDをname属性にして送信する。
    foreach($result1 as $value1): ?>
      <option value="<?php echo $value1["course_id"]; ?>">
      <?php echo $value1["course_id"]; ?>:<?php echo $value1["course_name"];?></option>
    <?php endforeach ?>
  </select>
</p>
<p>クラス：
  <select name="class">
    <?php
     //コース同様、ドロップダウン形式にして、IDをname属性で送信する。
     foreach($result2 as $value2):?>
      <option value="<?php echo $value2["class_id"];?>">
      <?php echo $value2["class_id"];?>:<?php echo $value2["c_name"]; ?></option>
      <?php endforeach ?>
  </select>
</p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>