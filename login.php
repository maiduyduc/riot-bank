<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="assets/img/icon.ico">
  <title>Wellcome to Riot Bank | Login</title>
  <link rel="stylesheet" href="./assets/bootstrap/css/login.css">
  <script src="./assets/js/jquery.min.js" charset="utf-8"></script>
</head>

<body>

  <form class="login-form" method="post">
    <p><img src="./assets/img/icon.ico" width="50px" /></p>
    <h1>Riot Bank</h1>

    <div class="txtb">
      <input type="text" name="stkk">
      <span data-placeholder="Account number"></span>
    </div>

    <div class="txtb">
      <input type="password" name="pass">
      <span data-placeholder="Password"></span>
    </div>

    <input type="submit" class="logbtn" name="login" value="Login">

    <div class="bottom-text">
      <a href="forgot-pass.php">Forgot password?</a>
    </div>
    <?php include('controll.php');
    if (isset($_POST['login'])) {
      $login = new Controll();
      $selectU = $login->SelectUser($_POST['stkk']);
      $selectP = $login->SelectPass($_POST['stkk']);
      $selectB = $login->Select_Balance($_POST['stkk']);
      if ($selectU == 0) echo "<script>alert('Tài khoản không tồn tại!')</script>";
      else {
        foreach ($selectP as $sP) {
          $sP['pass'];
        }
        if ($sP['pass'] != $_POST['pass']) echo "<script>alert('Sai pass!')</script>";
        else {
          foreach($selectB as $sB){
            $sB['stk'];
          }
          if($sB['stk'] == $_POST['stkk']) $balance = $sB['balance'];
          $_SESSION['name'] = $sP['name'];
          $_SESSION['email'] = $sP['email'];
          $_SESSION['stk'] = $sP['stk'];
          $_SESSION['balance'] = $balance;
          
          header('location:index.php');
        }
      }
    }

    ?>
  </form>


</body>

</html>
<script type="text/javascript">
  $(".txtb input").on("focus", function() {
    $(this).addClass("focus");
  });

  $(".txtb input").on("blur", function() {
    if ($(this).val() == "")
      $(this).removeClass("focus");
  });
</script>
<script>
  var close = document.getElementsByClassName("closebtn");
  var i;

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.opacity = "0";
      setTimeout(function() {
        div.style.display = "none";
      }, 600);
    }
  }
</script>