<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="assets/img/icon.ico">
  <title>Quên mật khẩu</title>
  <link rel="stylesheet" href="./assets/bootstrap/css/login.css">
  <script src="./assets/js/jquery.min.js" charset="utf-8"></script>
</head>

<body>

  <form class="login-form" method="post">
    <p><img src="./assets/img/icon.ico" width="50px" /></p>
    <h1>Riot Bank</h1>
    <h4>Forgot Your Password?</h4>
    <p>We get it, stuff happens. Just enter your email address below and we'll send you your password!</p>
    <div class="txtb">
      <input type="email" name="email" required>
      <span data-placeholder="Email"></span>
    </div>

    <input type="submit" class="logbtn" name="reset" value="Reset Password">

    <div class="bottom-text">
      <a href="login.php">Already have an account? Login!</a>
    </div>
    <?php include('controll.php');
    if (isset($_POST['reset'])) {
      $login = new Controll();
      $selectP = $login->SelectEmail($_POST['email']);

      if ($selectP == null) echo "<script>alert('Tài khoản không tồn tại!')</script>";
      else {
        foreach ($selectP as $sP) {
          $sP['email'];
        }
        if ($sP['email'] == $_POST['email']) {
            $text = "Mật khẩu của bạn là: ".$sP['pass'];
            $login->SendMail($sP['email'], $sP['name'], "Riot Bank: Quên mật khẩu!", $text);
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