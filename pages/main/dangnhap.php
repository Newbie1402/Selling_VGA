<?php

    if(isset($_POST['dangnhap']))
    {
        $email = $_POST['email'];
        $matkhau = md5($_POST['password']);
        $sql = "SELECT * FROM tbl_dangky WHERE email = '".$email."' AND matkhau='".$matkhau."' LIMIT 1";
        $row=mysqli_query($mysqli,$sql);
        $count=mysqli_num_rows($row);
        if($count>0)
        {
            $row_data=mysqli_fetch_array($row);
            $_SESSION['dangky']=$row_data['tenkhachhang'];
            $_SESSION['id_khachhang']=$row_data['id_dangky'];
            header("Location:index.php?quanly=index");

        }

        else
        {
            echo '<p>Email hoặc mật khẩu của bạn không đúng, vui lòng nhập lại</p';
            echo '<script></script>';

        }

    }
    else if(isset($_POST['guest']))
    {
        $_SESSION['dangky']='GUEST';
        $_SESSION['id_khachhang']='13';
        header("Location:index.php?quanly=index");
    }
?>
<div class="dangnhap" >
<form method="POST" action="" autocomplete="off">
        <table >
            <tr style="text-align: center">
                <td colspan="2"><img src="image/LogoHTVGA.png" width="150px"></td>
                
            </tr>
            <tr>
                <td>Email:</td>
                <td ><input type="text" name="email"><td>
            </tr>
            
                
            
            <tr>
                <td>Mật khẩu:</td>
                <td ><input type="password" name="password"><td>
            </tr>

            <tr style="text-align: center" id=loginbutton>
            
                <td colspan="2"><input type="submit" name="dangnhap" value="Đăng nhập"><td>

            </tr>
            <tr style="text-align: center" id=loginbutton>

                <td colspan="3"><input type="submit" name="guest" value="Đăng nhập Guest"></td>
            </tr>
        </table>
    </form>
</div>