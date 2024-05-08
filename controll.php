<?php 
    require('connect.php');
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;
    class Controll{


        public function SelectUser($stk)
        {
            # code...
            global $conn;
            $sql = "select * from t_account where stk = '$stk'";
            $run = mysqli_query($conn, $sql);
            $datarow = mysqli_num_rows($run);
            return $datarow;
        }

        //funtion chọn pass
        public function SelectPass($stk){
            global $conn;
            $sql = "select * from t_account where stk = '$stk'";
            $run = mysqli_query($conn, $sql);
            $data = array();
            if($run){
                while($rows=mysqli_fetch_array($run)){
                    $data[] = $rows;
                }
            }
            return $data;
        }

        public function SelectEmail($email){
            global $conn;
            $sql = "select * from t_account where email = '$email'";
            $run = mysqli_query($conn, $sql);
            $data = array();
            if($run){
                while($rows=mysqli_fetch_array($run)){
                    $data[] = $rows;
                }
            }
            return $data;
        }

        //function đổi mật khẩu
        public function Update_pass($stk, $pass)
        {
            global $conn;
            $sql = "update t_account set pass = '$pass' where stk = '$stk'";
            $run = mysqli_query($conn, $sql);
            return $run;
        }

        //function nạp tiền - chuyển tiền
        public function Update_Balance($stk, $balance)
        {
            global $conn;
            $sql = "update t_balance set balance = '$balance' where stk = '$stk'";
            $run = mysqli_query($conn, $sql);
            return $run;
        }

        //function kiểm tra số dư
        public function Select_Balance($stk)
        {
            global $conn;
            $sql = "select * from t_balance where stk = '$stk'";
            $run = mysqli_query($conn, $sql);
            $data = array();
            if($run){
                while($rows=mysqli_fetch_array($run)){
                    $data[] = $rows;
                }
            }
            return $data;
        }
        
        //function gửi mail
        public function SendMail($email, $receiver, $subject, $content)
        {
                $mail = new PHPMailer(true);                              
                try {
                    $mail->isSMTP(); // using SMTP protocol                                     
                    $mail->Host = 'smtp.gmail.com;smtp1.gmail.com;smtp2.gmail.com'; // SMTP host as gmail 
                    $mail->SMTPAuth = true;  // enable smtp authentication                             
                    $mail->Username = '';  // sender gmail host              
                    $mail->Password = ''; // sender gmail host password                          
                    $mail->SMTPSecure = 'tls';  // for encrypted connection                           
                    $mail->Port = 587;   // port for SMTP   
                    $mail->CharSet = 'UTF-8';  
                    $mail->Encoding = 'base64';
                    $mail->setFrom('matrixpro.felix@gmail.com', "RiotBank"); // sender's email and name
                    $mail->addAddress($email, $receiver);  // receiver's email and name

                    // $mail->Encoding = "utf-8";
                    $mail->Subject = $subject;
                    $mail->Body    = $content;
                    //===============
                    $mail->send();
                    echo "<script>alert('Gửi mail thành công!')</script>";
                } catch (Exception $e) { // handle error.
                    echo "<script>alert('Gửi mail thất bại!')</script>", $mail->ErrorInfo;
            }
        }
    }
?>
