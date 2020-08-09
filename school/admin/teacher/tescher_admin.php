<?php
require_once (dirname(__FILE__).'/../../admin_common.php');

if(!isset($_SESSION)){
session_start();
}

try{//データベースからテーブルデータを取得します。
  $pdo = new PDO(db_name, user, pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $pdo->query("SELECT * FROM teacher ORDER BY id ASC");
}catch(PDOException $e){
  echo "Connection failed.".$e->getMessage().'\n';
  exit();
}
 //コースのドロップダウン
 $stmt2 = $pdo->query("SELECT * from course");
 $result1 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

 //クラスのドロップダウン
 $stmt3 = $pdo->query("SELECT * from class");
 $result2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　教師情報管理ページ</title>
</head>
<body>
<h1>教師情報 管理ページ</h1>
<hr>
<p><a href="teacher_add.php">教師情報追加</a></p>
<hr>
<table border ="2">
  <tr>
  <th></th><th>番号</th><th>氏名</th><th>担当教科</th><th>担当クラス</th>
  </tr>
<?php if(!empty($stmt)): ?>
    <?php foreach ($stmt as $value): ?>
      <article>
      <tr><td><a href="teacher_edit.php?id=<?php echo $value['id']; ?>">教師情報編集</a></td>
          <?php echo '<td>'.$value['id'].'</td>';
                echo '<td>'.$value['t_name'].'</td>';
                echo '<td>'.$value['k_id'].'</td>';
                echo '<td>'.$value['tantou'].'</td>';?>
        <td><a href="teacher_del.php?id=<?php echo $value['id']; ?>">教師情報削除</a></td></tr>
      </article>
    <?php endforeach; ?>
<?php endif; ?>
</table>
<hr>
<a href="../index.php">管理ページへ戻る</a>
</body>
</html>