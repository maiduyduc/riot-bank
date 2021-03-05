<?php
session_start();
if (empty($_SESSION['stk'])) header("location:login.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Riot auto Bank</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="assets/img/icon.ico">
    <link rel="stylesheet" href="./assets/bootstrap/css/test.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/ionicons.min.css">
    <script src="./assets/js/3.5.0/jquery.min.js"></script>
</head>

<body>
<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
              <div class="container-fluid">
                <span class="d-none d-lg-inline mr-2 text-gray-600 big">
                  <a href="index.php"><img src="./assets/img/riot_logo.png" width="150px"></a>
                </span>
                <ul class="nav navbar-nav flex-nowrap ml-auto">
                  <div class="d-none d-sm-block topbar-divider"></div>
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link"><span class="d-none d-lg-inline mr-2 text-gray-600 small">
                        <?php echo $_SESSION['name']; ?>
                      </span>
                      <img class="border rounded-circle img-profile" src="./assets/img/icon.ico">
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
    <div class="wrap">
        <form method="post">
            <div class="container">
                
                <div class="btn-flex">
                    <div class="l1">
                        <button class="item i1" type="submit" name="ruttien">
                            <i class="ion-cash"></i>
                            <span>Rút tiền</span>
                        </button>
                        <button class="item i2" type="submit" name="chuyenkhoan">
                            <i class="ion-android-share"></i>
                            <span>Chuyển khoản</span>
                        </button>
                    </div>
                    <div class="l2">
                        <button class="item i3" type="submit" name="vantin">
                            <i class="ion-information"></i>
                            <span>Vấn tin</span>
                        </button>
                        <button class="item i4" type="submit" name="doipass">
                            <i class="ion-ios-keypad"></i>
                            <span>Đổi mật khẩu</span>
                        </button>
                    </div>

                    <div class="l3">
                        <button class="item i5" type="submit" name="naptien">
                            <i class="ion-social-usd"></i>
                            <span>Nạp tiền</span>
                        </button>
                        <button class="item i6" type="submit" name="thoat">
                            <i class="ion-android-exit"></i>
                            <span>Thoát</span>
                        </button>
                        <?php
                            if (isset($_POST['ruttien'])) {
                                header('location:withdraw.php');
                            }
                            if (isset($_POST['thoat'])) {
                                header('location:logout.php');
                            }
                            if (isset($_POST['chuyenkhoan'])) {
                                header('location:transfers.php');
                            }
                            if (isset($_POST['naptien'])) {
                                header('location:payin.php');
                            }
                            if (isset($_POST['doipass'])) {
                                header('location:change_pass.php');
                            }
                            if (isset($_POST['vantin'])) {
                                header('location:info.php');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>