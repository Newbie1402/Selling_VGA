<?php
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['dangky']))
    {

        ob_start();
        
        $tenkhachhang = $_POST['hovaten'];
        $email = $_POST['email'];
        $dienthoai = $_POST['dienthoai'];
        $matkhau = $_POST['matkhau'];
        $xacnhanmatkhau = $_POST['xacnhanmatkhau'];
        $diachi = $_POST['diachi'];

        // Validate
        $errors = array();

        if (strlen($tenkhachhang) < 8) {
            $errors[] = 'Họ tên phải tối thiểu 8 kí tự';
        }

        if (!preg_match('/^[A-Za-z0-9!@#$%^&*()_+=\-{}\[\]:;"\'<>?,.\/]+$/', $matkhau) || strlen($matkhau) < 4) {
            $errors[] = 'Mật khẩu phải có chữ viết hoa và số tối thiểu 4 ký tự.';
        }

        if ($matkhau != $xacnhanmatkhau) {
            $errors[] = 'Mật khẩu và xác nhận mật khẩu không khớp';
        }

        if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
            $errors[] = 'Email phải có đuôi @gmail.com';
        }

        if (!preg_match('/^[0-9]{10}$/', $dienthoai)) {
            $errors[] = 'Điện thoại phải có đúng 10 số không có ký tự hoặc chữ';
        }

        if (empty($errors)) {
            $matkhau = md5($matkhau);

            $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) VALUES('$tenkhachhang','$email','$diachi','$matkhau','$dienthoai')");

            if($sql_dangky)
            {
                echo '<p style="color: green;">Đăng ký thành công </p>';
                $_SESSION['dangky'] = $tenkhachhang;
                $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
                header('Location: index.php?quanly=dangnhap');
                exit();
            }
        } else {
            foreach ($errors as $error) {
                echo '<p style="color: red;">' . $error . '</p>';
            }
        }

        ob_end_flush();
    }
?>
<div class="dangki">
<form action="" method="POST">
    <table style="border-collapse: collapse; ">
            <tr style="text-align: center;">
                <td colspan="2"><img src="image/LogoHTVGA.png" width="150px"></td>
            </tr>
        <tr>
            <td >Họ và tên:</td>
            <td><input placeholder="Tối thiểu 8 kí tự" type="text" size="70" name="hovaten" required></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input placeholder="Phải có đuôi @gmail.com, vd:ab@gmail.com" type="email" size="70" name="email" required></td>
        </tr>
        <tr>
            <td>Điện thoại:</td>
            <td><input placeholder="Phải đúng số đt chuẩn 10 số" type="tel" size="70" name="dienthoai" required></td>
        </tr>
<!--         <tr>
            <td>Địa chỉ:</td>
            <td><input type="text" size="70" name="diachi" required></td>
        </tr> -->
        <tr>
            <td>Mật khẩu:</td>
            <td><input placeholder="Mật khẩu phải có chữ viết hoa và số tối thiểu 4 ký tự" type="password" size="70" name="matkhau" required></td>
        </tr>
        <tr>
            <td>Xác nhận mật khẩu:</td>
            <td><input placeholder="Vui lòng nhập lại mật khẩu" type="password" size="70" name="xacnhanmatkhau" required></td>
        </tr>
        <tr id="rbutton">
            <td colspan="2"><input type="submit" name="dangky" value="Đăng kí"></td>
        </tr>
        <tr >
            <td colspan="2"><p>Đã có tài khoản? <a href="index.php?quanly=dangnhap" style="color: green;">Đăng nhập ngay</a></p></td>
        </tr>
    </table>
</form>
</div>