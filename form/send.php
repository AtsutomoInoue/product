<?php
//PHPMailerを使用しています。
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";


  $header = null;
  $body = null;
  $auto_reply_subject = null;
  $auto_reply_text = null;
  $admin_reply_subject = null;
  $admin_replt_text = null;
  date_default_timezone_set('Asia/Tokyo');

  mb_language("ja");
  mb_internal_encoding("UTF-8");

  $header = "MIME-Version: 1.0\n";
  $header = "Content-Type: multipart/mixed;boundary=\"__BOUNDARY__\"\n";
  $header .= "From: ABCDEFG<noreply@abcdefg.com>\n";
  $header .= "Reply-to: ABCDEFG<noreply@abcdefg.com>\n";


//問い合わせ側の自動返信メール部分
  $auto_reply_subject = 'お問い合わせ有り難う御座います。';

  $auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
  下記の内容でお問い合わせを受け付けました。\n\n";
  $auto_reply_text .= "お問い合わせ日時：".date("Y-m-d H:i")."\n";
  $auto_reply_text .= "氏名：". $_POST['your_name'] . "\n";
  $auto_reply_text .= "メールアドレス：" .$_POST['email'] ."\n\n";
  if( $_POST['gender'] === "male" ) {
    $auto_reply_text .= "性別：男性\n";
    } else {
    $auto_reply_text .= "性別：女性\n";
    }
  if( $_POST['age'] === "1"){
    $auto_reply_text .= "年齢：〜19歳\n";
  }elseif( $_POST['age'] === "2"){
    $auto_reply_text .= "年齢：20歳〜29歳\n";
  }elseif( $_POST['age'] === "3"){
    $auto_reply_text .= "年齢：30歳〜39歳\n";
  }elseif( $_POST['age'] === "4"){
    $auto_reply_text .= "年齢：40歳〜49歳\n";
  }elseif( $_POST['age'] === "5"){
    $auto_reply_text .= "年齢：50歳〜59歳\n";
  }elseif( $_POST['age'] === "6"){
    $auto_reply_text .= "年齢：60歳～\n";
  }
  $auto_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";
  $auto_reply_text .= "ABCDEFG株式会社　総務部";

  // テキストメッセージをセット
  $body = "--__BOUNDARY__\n";
  $body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
  $body .= $auto_reply_text . "\n";	$body .= "--__BOUNDARY__\n";
	// ファイルを添付
  if( !empty($clean['attachment_file']) ) {
    $body .= "Content-Type: application/octet-stream; name=\"{$clean['attachment_file']}\"\n";
    $body .= "Content-Disposition: attachment; filename=\"{$clean['attachment_file']}\"\n";
    $body .= "Content-Transfer-Encoding: base64\n";		$body .= "\n";
    $body .= chunk_split(base64_encode(file_get_contents(FILE_DIR.$clean['attachment_file'])));
    $body .= "--__BOUNDARY__\n";	}

 try{
   $mail->SMTPDebug = 0; //SMTPのデバック情報を表示。
   $mail->isSMTP();
   $mail->Host = 'ホスト名';
   $mail->SMTPAuth = true;
   $mail->Username = 'ユーザー名';
   $mail->Password = 'パスワード';
   $mail->SMTPSecure = 'tls';
   $mail->Port = 2525;

   //ヘッダ情報
   $mail->setFrom($clean['email'], $clean['email']); //アドレスだけでも動きます
   $mail->addAddress('sample@testtest.com', 'テストメール');

   //入力した内容を格納
   $mail->CharSet = 'UTF-8'; //文字化け防止
   $mail->Subject = $auto_reply_subject;
   $mail->Body    = $auto_reply_text;
   $mail->Body    = $body;

   //送信
   $mail->send();

  }catch(Exception $e){
   echo "error:".$mail->ErrorInfo;
  }




//運営側への自動返信メール
//送信されたメール情報を記載
  $admin_reply_subject = 'お問い合わせを受け付けました。';

  $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
  $admin_reply_text .= "お問い合わせ日時：".date("Y-m-d H:i")."\n";
  $admin_reply_text .= "氏名：". $_POST['your_name'] . "\n";
  $admin_reply_text .= "メールアドレス：" .$_POST['email'] ."\n\n";
  if( $_POST['gender'] === "male" ) {
		$admin_reply_text .= "性別：男性\n";
  	} else {
    $admin_reply_text .= "性別：女性\n";
  	}
  if( $_POST['age'] === "1"){
    $admin_reply_text .= "年齢：〜19歳\n";
  }elseif( $_POST['age'] === "2"){
    $admin_reply_text .= "年齢：20歳〜29歳\n";
  }elseif( $_POST['age'] === "3"){
    $admin_reply_text .= "年齢：30歳〜39歳\n";
  }elseif( $_POST['age'] === "4"){
    $admin_reply_text .= "年齢：40歳〜49歳\n";
  }elseif( $_POST['age'] === "5"){
    $admin_reply_text .= "年齢：50歳〜59歳\n";
  }elseif( $_POST['age'] === "6"){
    $admin_reply_text .= "年齢：60歳～\n";
  }
  $admin_reply_text .= "お問い合わせ内容：" . nl2br($_POST['contact']) . "\n\n";

  // テキストメッセージをセット
  	$body = "--__BOUNDARY__\n";
    $body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
    $body .= $admin_reply_text . "\n";
    $body .= "--__BOUNDARY__\n";
	// ファイルを添付
  	if( !empty($clean['attachment_file']) ) {
      $body .= "Content-Type: application/octet-stream; name=\"{$clean['attachment_file']}\"\n";
      $body .= "Content-Disposition: attachment; filename=\"{$clean['attachment_file']}\"\n";
      $body .= "Content-Transfer-Encoding: base64\n";		$body .= "\n";
      $body .= chunk_split(base64_encode(file_get_contents(FILE_DIR.$clean['attachment_file'])));
      $body .= "--__BOUNDARY__\n";
    	}

    try{

        //mailtrapを使ってます。
        $mail->SMTPDebug = 0; //SMTPのデバック情報を表示。
        $mail->isSMTP();
        $mail->Host = 'ホスト名';
        $mail->SMTPAuth = true;
        $mail->Username = 'ユーザー名';
        $mail->Password = 'パスワード';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        //ヘッダ情報
        $mail->setFrom($clean['email'], $clean['email']); //アドレスだけでも動きます
        $mail->addAddress('to@example.com', 'Testmail');

        //入力した内容を格納
        $mail->CharSet = 'UTF-8'; //文字化け防止
        $mail->Subject = $admin_reply_subject;
        $mail->Body    = $admin_reply_text;
        $mail->Body    = $body;

        //送信
        $mail->send();

    }catch(Exception $e){
        echo "error:".$mail->ErrorInfo;
    }
?>
