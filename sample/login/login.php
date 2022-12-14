<?php
    $id = "";
    $email = "";
    $password = "";
    $error = array();
    //DBの情報
    require_once 'DBConnect.php';
    $class = new DBConnect();
    $a = $class->getUsermail($_POST['email']);
    

        $error['mail'] = '';
        $error['password'] = '';

        //POST判定
        if(!empty($_POST)){
            $mail = $_POST['email'];
            $pass = $_POST['password'];

            //空白チェック
            if ($mail == '') {
                $error['mail'] = 'メールアドレスが未入力です。';
              }
              //メールアドレス形式チェック

              //パスワード空白チェック
              if ($pass == '') {
                $error['password'] = 'パスワードが未入力です。';
              }
              //
              if($error['mail'] == "" && $error['password'] == "" ){
                foreach($a as $row){
                  if($_POST['email'] == $row['mail']){
                    $data = $row['pass'];
		    $id = $row['user_id'];
                  }
                }
                if($data == $pass){
                  //セッションにemailアドレスを挿入する
		  session_start();
                  $_SESSION['user_id'] = $id;
                  //マイページへ遷移
                  header('Location:http://cool-saga-5604.pupu.jp/sample/mypage/mypage.html');

                  exit;
                }else{
                  $error['mail'] = 'eメールアドレスまたはパスワードが違います';
                }
            }

        }

?>
<!DOCTYPE html>
<html>
    <head>
<meta http-equir="content-type" charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="stylesheet" href="css/style.css">

<link href='https://fonts.googleapis.com/css?family=Imperial Script' rel='stylesheet'>
<link href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">            
    <div class="container-fluid">
    <a class="navbar-brand" style="font-family: 'Imperial Script'; font-size: 40px">Mentai's</a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
      </div>
</div>
  </nav>

    </head>
    <body>
<form action="" method="post">
   	<div class="textbox">
        <!--テキストボックス-->
      
        <div class="d-flex justify-content-center"> 
          <input type="email" class="box2" name="email" placeholder="Mail Address">
</div>
        <div class="d-flex justify-content-center"> 
        <input type="password" class="box2" name="password" placeholder="Password">
	</div>

        <div class="err"><?php echo $error['mail']; ?></div>
        <div class="err"><?php echo $error['password']; ?></div>
        <div class="logbtn">
	    
            <!--ログインボタン-->
            <input type="submit" class="btn btn-dark" class="text-center"  value="Login">
            
        </div>
    </div>
</form>
</html>