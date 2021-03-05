<?php
session_start();
if (empty($_SESSION['stk'])) header("location:login.php");
require('controll.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chuyển khoản</title>
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
                        <form method="post">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row btn-flex">
                                                <input class="form-control" type="text" value="<?php if (isset($_POST['check'])) echo $_POST['stk']; ?>" placeholder="Nhập số tài khoản người nhận" name="stk">
                                            </div>
                                            <div class="row btn-flex">
                                                <input class="form-control" type="text" value="<?php if (isset($_POST['check'])) echo $_POST['money']; ?>" placeholder="Nhập số tiền chuyển" name="money">
                                            </div>
                                            <div class="row">
                                                <button disabled class="btn btn-primary btn-sm" name="check" type="submit">KIỂM TRA</button>
                                            </div>
                                            <div class="row">
                                                <button disabled class="btn btn-primary btn-sm" name="up" type="submit">CHUYỂN KHOẢN</button>
                                            </div>
                                            <div class="row" style="height: 190px;">
                                                <!-- 240 -->
                                                <?php

                                                if (isset($_POST['check'])) {

                                                    if ($_POST['money'] > $sB['balance']) {
                                                ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Bạn không có đủ tiền để chuyển.
                                                        </div>
                                                    <?php
                                                    } elseif ($_POST['stk'] == $_SESSION['stk']) {
                                                    ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Bạn không thể tự chuyển tiền cho mình.
                                                        </div>
                                                        <?php
                                                    } else {
                                                        $selectB = $control->Select_Balance($_POST['stk']);
                                                        $selectU = $control->SelectPass($_POST['stk']);
                                                        if ($selectB == null) {
                                                        ?>
                                                            <div class="alert">
                                                                <span class="closebtn">&times;</span>
                                                                Sai số tài khoản người nhận, vui lòng kiểm tra lại.
                                                            </div>
                                                            <?php
                                                        } else {
                                                            // foreach ($selectB as $sB) {
                                                            //     $sB['stk'];
                                                            // }
                                                            foreach ($selectU as $sU) {
                                                                $sU['stk'];
                                                            }

                                                            if ($sU['stk'] == $_POST['stk']) {
                                                            ?>
                                                                <div class="alert" style="background-color: #27ae60;">
                                                                    <span class="closebtn">&times;</span>
                                                                    Thông tin chuyển khoản <br>
                                                                    Người nhận: <?php echo $sU['name']; ?> <br>
                                                                    STK: <?php echo $sU['stk']; ?> <br>
                                                                    Email: <?php echo $sU['email']; ?> <br>
                                                                    Số tiền chuyển: <?php echo number_format($_POST['money']) ?> VNĐ
                                                                    <script>
                                                                        var btn = document.querySelectorAll(".btn");
                                                                        btn[0].disabled = false;
                                                                        btn[1].disabled = false;
                                                                    </script>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                    }
                                                }

                                                if (isset($_POST['up'])) {
                                                    $tf = false;
                                                    if ($_POST['money'] > $sB['balance']) {
                                                        ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Bạn không có đủ tiền để chuyển.
                                                        </div>
                                                    <?php
                                                    } elseif ($_POST['money'] < 0) {
                                                    ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Vui lòng nhập số tiền hợp lệ.
                                                        </div>
                                                    <?php
                                                    } elseif ($_POST['stk'] == $_SESSION['stk']) {
                                                    ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Bạn không thể tự chuyển tiền cho mình.
                                                        </div>
                                                        <?php
                                                    } else {
                                                        $selectB = $control->Select_Balance($_POST['stk']);
                                                        $selectU = $control->SelectPass($_POST['stk']);
                                                        if ($selectB == null) {
                                                        ?>
                                                            <div class="alert">
                                                                <span class="closebtn">&times;</span>
                                                                Sai số tài khoản người nhận, vui lòng kiểm tra lại.
                                                            </div>
                                                <?php
                                                        } else {
                                                            foreach ($selectU as $sU) {
                                                                $sU['stk'];
                                                            }
                                                            if ($sU['stk'] == $_POST['stk']) {
                                                                $email = $sU['email'];
                                                                $name = $sU['name'];
                                                                $i_stk = $sU['stk'];
                                                            }
                                                            foreach ($selectB as $sB) {
                                                                $sB['stk'];
                                                            }
                                                            if ($sB['stk'] == $_POST['stk']) {
                                                                $newBalance = $sB['balance'] + $_POST['money'];
                                                                $text = "Bạn vừa nhận được: " . number_format($_POST['money']) . " VNĐ từ: " . $_SESSION['name'] . " (STK: " . $_SESSION['stk'] . "). Số dư hiện tại: " . number_format($newBalance)." VNĐ";
                                                                $control->SendMail($email, $name, "Thông báo giao dịch", $text);
                                                                //===
                                                                $control->Update_Balance($sB['stk'], $newBalance);
                                                                $tf = true;
                                                            }
                                                            if ($tf == true) {
                                                                $selectB = $control->Select_Balance($_SESSION['stk']);
                                                                foreach ($selectB as $sB) {
                                                                    $sB['stk'];
                                                                }
                                                                if ($sB['stk'] == $_SESSION['stk']) {
                                                                    $newBalance = $sB['balance'] - $_POST['money'];
                                                                    $text = "Bạn vừa chuyển thành công: " . number_format($_POST['money']) . " VNĐ cho: " . $name  . " (STK: " . $i_stk . "). Số dư hiện tại: " . number_format($newBalance)." VNĐ";
                                                                    $control->SendMail($_SESSION['email'], $_SESSION['name'], "Thông báo giao dịch", $text);
                                                                    //===
                                                                    $control->Update_Balance($sB['stk'], $newBalance);
                                                                    echo "<script>alert('Chuyển tiền thành công!')</script>";
                                                                    echo ("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP META 
                                                                } else {
                                                                    echo "<script>alert('Chuyển tiền thất bại!')</script>";
                                                                    echo ("<meta http-equiv='refresh' content='1'>"); //Refresh by HTTP META 
                                                                }
                                                            }
                                                        }
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
<script>
    var fields = document.querySelectorAll(".row input");
    var btn = document.querySelectorAll(".btn");

    function check() {
        if (fields[0].value != "" && fields[1].value != "") {
            btn[0].disabled = false;
            btn[1].disabled = false;
        } else {
            btn[0].disabled = true;
            btn[1].disabled = true;
        }
    }
    fields[0].addEventListener("keyup", check);
    fields[1].addEventListener("keyup", check);
</script>