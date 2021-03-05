<?php
session_start();
if (empty($_SESSION['stk'])) header("location:login.php");
require('controll.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rút tiền</title>
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
                                            <!-- <div class="row btn-flex"> -->
                                            <!-- <input class="form-control" type="text" placeholder="Nhập số tiền muốn rút" name="money"> -->
                                            <div class="money">
                                                <div class="money_item">
                                                    <div><img src="./assets/img/money/500k.jpg" alt=""></div>
                                                    <div class="quantity">
                                                        <input type="number" name="c500" min="0" max="100" step="1" value="<?php if (isset($_POST['check'])) echo $_POST['c500']; else echo 0; ?>">
                                                    </div>
                                                </div>
                                                <div class="money_item">
                                                    <div><img src="./assets/img/money/200k.jpg" alt=""></div>
                                                    <div class="quantity">
                                                        <input type="number" name="c200" min="0" max="100" step="1" value="<?php if (isset($_POST['check'])) echo $_POST['c200']; else echo 0; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="money">
                                                <div class="money_item">
                                                    <div><img src="./assets/img/money/100k.jpg" alt=""></div>
                                                    <div class="quantity">
                                                        <input type="number" name="c100" min="0" max="100" step="1" value="<?php if (isset($_POST['check'])) echo $_POST['c100']; else echo 0; ?>">
                                                    </div>
                                                </div>
                                                <div class="money_item">
                                                    <div><img src="./assets/img/money/50k.jpg" alt=""></div>
                                                    <div class="quantity">
                                                        <input type="number" name="c50" min="0" max="100" step="1" value="<?php if (isset($_POST['check'])) echo $_POST['c50']; else echo 0; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="money">
                                                <div class="money_item">
                                                    <div><img src="./assets/img/money/20k.jpg" alt=""></div>
                                                    <div class="quantity">
                                                        <input type="number" name="c20" min="0" max="100" step="1" value="<?php if (isset($_POST['check'])) echo $_POST['c20']; else echo 0; ?>">
                                                    </div>
                                                </div>
                                                <div class="money_item">
                                                    <div><img src="./assets/img/money/10k.jpg" alt=""></div>
                                                    <div class="quantity">
                                                        <input type="number" name="c10" min="0" max="100" step="1" value="<?php if (isset($_POST['check'])) echo $_POST['c10']; else echo 0; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                            <div class="row">
                                                <button class="btn btn-primary btn-sm" name="check" type="submit">KIỂM TRA</button>
                                            </div>
                                            <div class="row">
                                                <button class="btn btn-primary btn-sm" name="up" type="submit">RÚT TIỀN</button>
                                            </div>
                                            <div class="row" style="height: 134px;">
                                                <?php
                                                $S500 = 500000;
                                                $S200 = 200000;
                                                $S100 = 100000;
                                                $S50 = 50000;
                                                $S20 = 20000;
                                                $S10 = 10000;
                                                $all = 0;
                                                if (isset($_POST['check'])) {
                                                    $C500 = $_POST['c500'];
                                                    $C200 = $_POST['c200'];
                                                    $C100 = $_POST['c100'];
                                                    $C50 = $_POST['c50'];
                                                    $C20 = $_POST['c20'];
                                                    $C10 = $_POST['c10'];
                                                    $all = ($S500 * $C500) + ($S200 * $C200) + ($S100 * $C100) + ($S50 * $C50) + ($S20 * $C20) + ($S10 * $C10);
                                                ?>
                                                    <div class="alert" style="background-color: #27ae60;">
                                                        <span class="closebtn">&times;</span>
                                                        Tổng tiền rút: <?php echo number_format($all); ?> VNĐ
                                                    </div>
                                                    <?php 
                                                }
                                                if (isset($_POST['up'])) {
                                                    $C500 = $_POST['c500'];
                                                    $C200 = $_POST['c200'];
                                                    $C100 = $_POST['c100'];
                                                    $C50 = $_POST['c50'];
                                                    $C20 = $_POST['c20'];
                                                    $C10 = $_POST['c10'];
                                                    $all = ($S500 * $C500) + ($S200 * $C200) + ($S100 * $C100) + ($S50 * $C50) + ($S20 * $C20) + ($S10 * $C10);
                                                    if ($all == 0) {
                                                    ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Số tiền rút phải lớn hơn 0đ.
                                                        </div>
                                                    <?php
                                                    } elseif ($all > $sB['balance']) {
                                                    ?>
                                                        <div class="alert">
                                                            <span class="closebtn">&times;</span>
                                                            Bạn không đủ tiền để rút.
                                                        </div>
                                                <?php
                                                    } else {
                                                        $newBalance = $sB['balance'] - $all;
                                                        $update = $control->Update_Balance($_SESSION['stk'], $newBalance);
                                                        $text = "Bạn vừa rút thành công: " . number_format($all) . " VNĐ. Số dư hiện tại: " . number_format($newBalance)." VNĐ";
                                                        if ($update) {
                                                            echo "<script>alert('Rút tiền thành công!')</script>";
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
    jQuery(
        '<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>'
    ).insertAfter(".quantity input");
    jQuery(".quantity").each(function() {
        var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find(".quantity-up"),
            btnDown = spinner.find(".quantity-down"),
            min = input.attr("min"),
            max = input.attr("max");

        btnUp.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function() {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });
    });
</script>