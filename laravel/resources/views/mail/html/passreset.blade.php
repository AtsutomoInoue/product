<!DOCUTYPE html>
<html lang="ja">
<style>
 body{
   background-color: #ffffff;
 }
 #title{
   background-color: #cdcdcd;
   margin: 25px 25px;
   padding: 20px 10px;
 }

 #title{
   text-align: center;
   font-size: 30;
 }

 h1{
   font-size: 16px;
   color: #ff6666;
   text-align: center;
 }
 #button{
   width: : 200px;
   text-align: center;
 }
 #button{
   padding: 10px 20px;
   display: block;
   border: 1px solid #2a88bd;
   background-color: #FFFFFF;
    color: #2a88bd;
    text-decoration: none;
    box-shadow: 5px 5px 3px #555555;
  }
  #button a:hover {
    background-color: #2a88bd;
    color: #FFFFFF;
  }
</style>
<body>
  <p id="title">LARAVELテスト</p>
  <h1>パスワードリセット</h1>
  <p>以下のボタンを押下し、パスワードリセットの手続きを行います。</p>
  <p id="button">
    <a href="{{$reset_url}}">パスワードのリセット</a>
  </p>
</body>
</html>
