<?php
require_once (dirname(__FILE__).'../../admin_common.php');

if(!isset($_SESSION)){
session_start();
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>学園管理　ユーザー情報追加</title>
</head>
<body>
<h1>ユーザー情報追加</h1>
<hr>
<form method="post" action="user_add2.php">
<p>ユーザー名：<input type="text" name="admin_user">※ユーザー名は英数字のみで入力してください。</p>
<p>パスワード：<input type="password" name="admin_pass"></p>
<p>管理権限：<input type="hidden" name="kanri" value="0">
<input type="checkbox" name="kanri" value="1"></p>
<input type="submit" value="確認画面へ">
</form>
<hr>
<a href="index.php">戻る</a>
</body>
</html>