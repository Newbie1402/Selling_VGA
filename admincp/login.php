<?php
    session_start();
    include('config/config.php');
    if(isset($_POST['dangnhap']))
    {
        $taikhoan = $_POST['username'];
        $matkhau = md5($_POST['password']);
        $sql = "SELECT * FROM tbl_admin WHERE username = '".$taikhoan."' AND password='".$matkhau."' LIMIT 1";
        $row=mysqli_query($mysqli,$sql);
        $count=mysqli_num_rows($row);
        if($count>0)
        {
            $_SESSION['dangnhap']=$taikhoan;
            header("Location:index.php");

        }

        else
        {
            echo '<script> arlert("Tài khoản hoặc mật khẩu bạn nhập không chính xác, vui long nhập lại ")</script>';
            header("Location:login.php");
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="css/styleadmincp.css">
</head>
<body>
<div class="wrapper_login">
    <form method="POST" action="" autocomplete="off">
        <table  style="text-align: center">
            <tr>
                <td colspan="2"><img src="../image/LogoHTVGA.png" width="150px"></td>
                
            </tr>
            <tr>
                <td>Tên đăng nhập:</td>
                <td ><input type="text" name="username"><td>
            </tr>
            
                
            
            <tr>
                <td>Mật khẩu:</td>
                <td ><input type="password" name="password"><td>
            </tr>

            <tr class="loginbuttonad">
   
                <td colspan="2" ><input type="submit" name="dangnhap" value="Đăng nhập"><td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>