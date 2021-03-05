<?php
session_start();
if (empty($_SESSION['stk'])) header("location:login.php");
require('controll.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Thông tin tài khoản</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="assets/img/icon.ico">
    <link rel="stylesheet" href="./assets/bootstrap/css/dashboard.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/ionicons.min.css">
    <script src="./assets/js/3.5.0/jquery.min.js"></script>
</head>

<body>
    <div class="wrap">
        <form method="post">
            <div class="container">
            <?php include('menu.php') ?>

                <div class="panel">
                    <div class="onLogin">
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
                    </div>
                    <div class="ruttien">
                        <div class="row">
                            <strong>Chủ tài khoản: <?php echo $_SESSION['name']; ?></strong>
                        </div>
                        <div class="row">
                            <strong>Email: <?php echo $_SESSION['email']; ?></strong>
                        </div>
                        <div class="row">
                            <strong>Số tài khoản: <?php echo $_SESSION['stk']; ?></strong>
                        </div>
                        <div class="row">
                            <strong>Số dư: 
                                <?php 
                                    $control = new Controll();
                                    $selectB = $control->Select_Balance($_SESSION['stk']);
                                    foreach($selectB as $sB){
                                        $sB['stk'];
                                      }
                                    if($sB['stk'] == $_SESSION['stk']) echo number_format($sB['balance'])." VNĐ";
                                ?>
                            </strong>
                        </div>
                        <div class="row" style="height: 307px;">
                            <strong></strong>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</body>

</html>