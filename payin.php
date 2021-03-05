<?php
session_start();
if (empty($_SESSION['stk'])) header("location:login.php");
require('controll.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nạp tiền</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="assets/img/icon.ico">
    <link rel="stylesheet" href="./assets/bootstrap/css/dashboard.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/ionicons.min.css">
    <script src="./assets/js/3.5.0/jquery.min.js"></script>
    <style>
        /* thong bao khi nhap sai mat khau */
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            left: 50%;
            transform: translate(-50%);
            width: 90%;
            position: absolute;
            bottom: 20px;
        }

        .alert.success {
            background-color: #4CAF50;
        }

        .alert.info {
            background-color: #2196F3;
        }

        .alert.warning {
            background-color: #ff9800;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
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
                            <strong>Số tài khoản: <?php echo $_SESSION['stk']; ?></strong>
                        </div>
                        <div class="row">
                            <strong>Số dư:
                                <?php
                                $control = new Controll();
                                $selectB = $control->Select_Balance($_SESSION['stk']);
                                foreach ($selectB as $sB) {
                                    $sB['stk'];
                                }
                                if ($sB['stk'] == $_SESSION['stk']) echo number_format($sB['balance'])." VNĐ";
                                ?>
                            </strong>
                        </div>
                        <form method="post" class="frm_ruttien">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row btn-flex">
                                                <input class="form-control" type="text" placeholder="Nhập&nbsp;số&nbsp;tiền&nbsp;muốn&nbsp;nạp" name="money">
                                            </div>
                                            <div class="row">
                                                <button class="btn btn-primary btn-sm" name="up" type="submit">NẠP TIỀN</button>
                                            </div>
                                            <div class="row" style="height: 302px;">
                                                <?php
                                                if (isset($_POST['up'])) {
                                                    if (empty($_POST['money'])) {
                                                ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Không được để trống.
                                                        </div>
                                                    <?php
                                                    } elseif ($_POST['money'] < 0) {
                                                    ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Vui lòng nhập số tiền hợp lệ.
                                                        </div>
                                                <?php
                                                    } else {
                                                        $newBalance = $sB['balance'] + $_POST['money'];
                                                        $update = $control->Update_Balance($_SESSION['stk'], $newBalance);
                                                        $text = "Bạn vừa nạp nạp thành công: " . number_format($_POST['money']) . " VNĐ. Số dư hiện tại: " . number_format($newBalance)." VNĐ";
                                                        if ($update) {
                                                            echo "<script>alert('Nạp tiền thành công!')</script>";
                                                            $control->SendMail($_SESSION['email'], $_SESSION['name'], "Thông báo giao dịch", $text);
                                                        } else {
                                                            echo "<script>alert('Lỗi, vui lòng kiểm tra lại!')</script>";
                                                        }
                                                        echo ("<meta http-equiv='refresh' content='1'>");
                                                    }
                                                }
                                                ?>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>