<?php
$value = null;
$pdo = new PDO("mysql:host=localhost;dbname=gohan", "testuser","testuser");
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>作成トップページ</title>
<link rel="stylesheet" href="css/base.css">
</head>
<body>
  <div class="title">作成物トップページ</div>
  <hr>

  <div class="gohan">
  <p>今日のごはんのお供の組み合わせは、
  <?php
  /*
  更新する度に名前が変わるようにSQL文を使用しています。
  maingohanテーブルとguzaiテーブルからランダムに取得し、それぞれをAS句で別名にしてから
  $value配列に格納させて表示しています。
  */
  $stmt = $pdo->prepare("SELECT name , ( select gname from guzai
     order by rand() limit 1 ) as a
     from maingohan as m order by rand() limit 1");
  $stmt->execute();
  foreach ($stmt as $value) {
      echo ('<div class="gohan1">'.$value['name'].'</div>と<div class="gohan2">'.$value['a'].'</div>');
    }
   ?>
 です。</p>
 </div>
<br>
<div class="pages">
<table border="3">
  <tr>
  <td><h1>メニュー</h1></td>
  </tr>
  <td><a href="./blog/index.php">ブログ</a>へ移動<br>
  ブログページに移動します。</td>
  </tr>
  <td><a href="./bbs/index.php">掲示板</a>へ移動<br>
  掲示板に移動します。</td>
  </tr>
  <td><a href="./form/index.php">問い合わせフォーム</a>へ移動<br>
  問い合わせフォームに移動します。</td>
  </tr>
</table>
</div>
</body>
</html>
