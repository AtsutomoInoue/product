<?php
//裏で動作するcheck.phpを呼び出しする。
require_once('check.php');

 ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>入力フォーム</title>
<link rel="stylesheet" href="css/base.css">
</head>
<body>
  <h1>お問い合わせ</h1>
  <!-- 入力確認のページ -->
  <?php if($page_flag === 1): ?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="element_wrap">
        <label>氏名：</label>
        <p><?php echo $_POST['your_name']; ?></p>
      </div>
      <div class="element_wrap">
        <label>メールアドレス：</label>
        <p><?php echo $_POST['email']; ?></p>
      </div>
      <div class="element_wrap">
        <label>性別：</label>
        <p><?php if($_POST['gender'] === "male"){echo '男性';}else{echo '女性';} ?></p>
      </div>
      <div class="element_wrap">
        <label>年齢：</label>
        <p>
          <?php if($_POST['age'] === "1"){echo '～19歳';}
          elseif($_POST['age'] === "2"){echo '20歳～29歳';}
          elseif($_POST['age'] === "3"){echo '30歳～39歳';}
          elseif($_POST['age'] === "4"){echo '40歳～49歳';}
          elseif($_POST['age'] === "5"){echo '50歳～59歳';}
          elseif($_POST['age'] === "6"){echo '60歳～';} ?>
        </p>
      </div>
      <div class="element_wrap">
        <label>お問い合わせ内容：</label>
        <p><?php echo nl2br($_POST['contact']); ?></p>
      </div>
      <?php if( !empty($clean['attachment_file'])): ?>
        <div class="element_wrap">
        <label>画像ファイルの添付：</label>
        <p><img src="<?php echo FILE_DIR.$clean['attachment_file']; ?>"></p>
        </div>
      <?php endif; ?>
      <div class="element_wrap">
        <label>プライバシーポリシー：</label>
        <p><?php if($_POST['agreement'] === "1"){
           echo '同意する';
         }else{
           echo '同意しない';
         } ?></p>
      </div>
      <input type="submit" name="btn_back" value="戻る">
      <input type="submit" name="btn_submit" value="送信">
      <input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
      <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
      <input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>">
      <input type="hidden" name="age" value="<?php echo $_POST['age']; ?>">
      <input type="hidden" name="contact" value="<?php echo $_POST['contact']; ?>">
      <input type="hidden" name="agreement" value="<?php echo $_POST['agreement']; ?>">
      <?php if(!empty($clean['attachment_file'])): ?>
      <input type="hidden" name="attachment_file" value="<?php echo $clean['attachment_file']; ?>">
    <?php endif; ?>
    </form>
    <!-- 送信時の動作 -->
    <?php elseif ($page_flag === 2):?>
      <p>送信が完了しました。</p>
      <p><a href="../index.php">戻る</a></p>
  <?php else: ?>
    <!-- 空欄があった場合のエラー動作 -->
    <?php if( !empty($error) ): ?>
    	<ul class="error_list">
    	<?php foreach( $error as $value ): ?>
    		<li><?php echo $value; ?></li>
    	<?php endforeach; ?>
    	</ul>
    <?php endif; ?>

    <!-- 項目入力のページ -->
  <form action="" method="post" enctype="multipart/form-data">
    <div class="element_wrap">
      <label>氏名</label>
      <input type="text" name="your_name" value="<?php
       if(!empty($_POST['your_name'])){
        echo $_POST['your_name'];
      } ?>">
    </div>
    <div class="element_wrap">
      <label>メールアドレス</label>
      <input type="text" name="email" value="<?php
       if(!empty($_POST['email'])){
        echo $_POST['email'];
      } ?>">
    </div>
    <div class="element_wrap">
      <label>性別</label>
      <label for="gender_male"></label>
      <input type="radio" id="gender_male" name="gender" value="male"
      <?php if(!empty($_POST['gender']) && $_POST['gender'] === "male"){
      echo 'checked';
      } ?>>男性</label>
      <input type="radio" id="gender_female" name="gender" value="female"
      <?php if(!empty($_POST['gender']) && $_POST['gender'] === "female"){
      echo 'checked';
      } ?>>女性</label>
    </div>
    <div class="element_wrap">
    <label>年齢</label>
    <select name="age">
      <option value="">選択してください</option>
      <option value="1" <?php if(!empty($_POST['age']) &&
      $_POST['age'] === "1"){ echo 'selected';}?>>～１９歳</option>
      <option value="2" <?php if(!empty($_POST['age']) &&
      $_POST['age'] === "2"){ echo 'selected';}?>>２０歳～２９歳</option>
      <option value="3" <?php if(!empty($_POST['age']) &&
      $_POST['age'] === "3"){ echo 'selected';}?>>３０歳～３９歳</option>
      <option value="4" <?php if(!empty($_POST['age']) &&
      $_POST['age'] === "4"){ echo 'selected';}?>>４０歳～４９歳</option>
      <option value="5" <?php if(!empty($_POST['age']) &&
      $_POST['age'] === "5"){ echo 'selected';}?>>５０歳～５９歳</option>
      <option value="6" <?php if(!empty($_POST['age']) &&
      $_POST['age'] === "6"){ echo 'selected';}?>>６０歳～</option>
    </select>
    </div>
      <div class="element_wrap">
        <label>お問い合わせ内容</label>
        <textarea name="contact"><?php if(!empty($_POST['contact'])){
          echo $_POST['contact']; } ?></textarea>
      </div>
      <div class="element_wrap">
        <label>画像ファイルの添付</label>
        <input type="file" name="attachment_file">
      </div>
      <div class="element_wrap">
        <label for="agreement"><input id="agreement" type="checkbox"
          name="agreement" value="1" <?php
          if(!empty($_POST['agreement']) && $_POST['agreement'] === "1"){
          echo 'checked';} ?>>プライバシーポリシーに同意する</label>
      </div>

    <input type="submit" name="btn_confirm" value="入力内容を確認する。">
    <a class="backhome" href="../index.php">トップページへ戻る</a>
  </form>
<?php endif; ?>
</body>
</html>
