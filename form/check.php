<?php
define( "FILE_DIR", "images/test/");

$page_flag = 0;
$clean = array();
$error = array();

if(!empty($_POST) ){
  foreach ($_POST as $key => $value) {
    $clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
  }
}


if(!empty($_POST['btn_confirm'])){
  $error = validation($clean);

  if(!empty($_FILES['attachment_file']['tmp_name'])){
    $upload_res = move_uploaded_file( $_FILES['attachment_file']['tmp_name'],
    FILE_DIR.$_FILES['attachment_file']['name']);

    if( $upload_res !== true){
      $error[] = 'ファイルのアップロードに失敗しました。';
    }else{
      $clean['attachment_file'] = $_FILES['attachment_file']['name'];
    }
  }

  if(empty($error)){ //エラー項目が空だった場合、確認ページに移行する。
  $page_flag = 1;

   session_start();
   $_SESSION['page'] = true;
  }
}elseif(!empty($_POST['btn_submit'])){

  session_start();
  if(!empty($_SESSION['page']) && $_SESSION['page'] === true){
    unset($_SESSION['page']);

  $page_flag = 2;
  require_once('send.php');

}else{
  $page_flag = 0;
}
}
function validation($data){ //入力されていない項目があった場合の動作。
  $error = array();

  if(empty($data['your_name'])){
    $error[] ="氏名が入力されていません。";
  }
  if(empty($data['email'])){
    $error[] ="メールアドレスが入力されていません。";
  }elseif(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
    //filter_var関数でチェックを行います。
  }else{
    $error[] = "メールアドレスは正しい形式で入力して下さい。";
  }

  if(empty($data['gender'])){
    $error[] = "性別を選択して下さい。";
  }elseif($data['gender'] !== 'male' && $data['gender'] !== 'female'){
    $error[] = "性別を選択して下さい。";
  }
  if(empty($data['age'])){
    $error[] = "年齢を選択して下さい。";
  }elseif( (int)$data['age'] < 1 || 6 < (int)$data['age']){
    $error[] = "年齢を選択して下さい。";
  }
  if(empty($data['contact'])){
    $error[] = "お問い合わせ内容が入力されていません。";
  }
  if(empty($data['agreement'])){
    $error[] = "プライバシーポリシーをご確認ください。";
  }elseif((int)$data['agreement'] !== 1){
    $error[] = "プライバシーポリシーをご確認ください。";
  }
  return $error;
}


?>
