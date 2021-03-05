<div class="btn-flex">
                    <div class="l1">
                        <button class="item i1" type="submit" name="ruttien">
                            <i class="ion-cash"></i>
                            <span>Rút tiền</span>
                        </button>
                    </div>
                    <div class="l2">
                        <button class="item i2" type="submit" name="chuyenkhoan">
                            <i class="ion-android-share"></i>
                            <span>Chuyển khoản</span>
                        </button>
                    </div>

                    <div class="l3">
                        <button class="item i3" type="submit" name="vantin">
                            <i class="ion-information"></i>
                            <span>Vấn tin</span>
                        </button>
                    </div>
                    <div class="l4">
                        <button class="item i4" type="submit" name="doipass">
                            <i class="ion-ios-keypad"></i>
                            <span>Đổi mật khẩu</span>
                        </button>
                    </div>

                    <div class="l5">
                        <button class="item i5" type="submit" name="naptien">
                            <i class="ion-social-usd"></i>
                            <span>Nạp tiền</span>
                        </button>
                    </div>
                    <div class="l6">
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