<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            margin: 20px auto;
            width: 77%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .arrow-steps {
            margin-bottom: 20px;
            text-align: center;
            margin-left :20%;
        }

        .arrow-steps .step {
            display: inline-block;
            padding: 10px 20px;
            background: #ddd;
            border-radius: 4px;
            margin-right: 10px;
            position: relative;
            color: #000;
        }

        .arrow-steps .step.done {
            background: #4caf50;
            color: white;
        }

        .arrow-steps .step.current {
            background: #ff9800;
            color: white;
        }

        .arrow-steps .step span a {
            text-decoration: none;
            color: inherit;
        }

        h4, h5 {
            margin-top: 20px;
            color: #333;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .cart-table th, .cart-table td {
            border-bottom: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        .cart-table th {
            background-color: #f8f8f8;
            color: #555;
            text-transform: uppercase;
        }

        .cart-table img {
            max-width: 90px;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #d9534f;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .total-row {
            font-weight: bold;
            font-size: 18px;
            color: red;
        }

        .form-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border: 3px solid #ffc0cb;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .thongtinvanchuyen {
            font-size: 30px;
            color: green;
        }
    </style>
</head>
<body>
<div class="container">


    <div class="row">
        <div class="col-md-8">
            <div class="form-container">
                <h4 class="thongtinvanchuyen">Thông tin vận chuyển</h4>
                <?php
                if (isset($_POST['themvanchuyen'])) {
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $note = $_POST['note'];
                    $id_dangky = $_SESSION['id_khachhang'];
                    $sql_them_vanchuyen = mysqli_query($mysqli, "INSERT INTO tbl_shipping(name, phone, address, note, id_dangky) VALUES('$name', '$phone', '$address', '$note', '$id_dangky')");
                    if ($sql_them_vanchuyen) {
                        echo '<p style="color: green;">Thêm thành công </p>';
                    } else {
                        echo '<p style="color: red;">Thêm không thành công </p>';
                    }
                } elseif (isset($_POST['capnhatvanchuyen'])) {
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $note = $_POST['note'];
                    $id_dangky = $_SESSION['id_khachhang'];
                    $sql_update_vanchuyen = mysqli_query($mysqli, "UPDATE tbl_shipping SET name='$name', phone='$phone', address='$address', note='$note' WHERE id_dangky='$id_dangky'");
                    if ($sql_update_vanchuyen) {
                        echo '<p style="color: green;">Cập nhật thành công </p>';
                    } else {
                        echo '<p style="color: red;">Cập nhật không thành công </p>';
                    }
                }
                ?>

                <?php
                $id_dangky = $_SESSION['id_khachhang'];
                $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
                $count = mysqli_num_rows($sql_get_vanchuyen);
                if ($id_dangky == 13) {
                    $name = '';
                    $phone = '';
                    $address = '';
                    $note = '';
                }
                else if ($count > 0) {
                    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
                    $name = $row_get_vanchuyen['name'];
                    $phone = $row_get_vanchuyen['phone'];
                    $address = $row_get_vanchuyen['address'];
                    $note = $row_get_vanchuyen['note'];
                } else {
                    $name = '';
                    $phone = '';
                    $address = '';
                    $note = '';
                }
                ?>
           
                <form action="" autocomplete="off" method="POST">
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address ?>">
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú</label>
                        <input type="text" name="note" class="form-control" value="<?php echo $note ?>">
                    </div>
                    <?php
                    if ($name == '' && $phone == '') {
                        ?>
                        <button type="submit" name="themvanchuyen" class="btn btn-primary">Thêm vận chuyển</button>
                        <?php
                    } else {
                        ?>
                        <button type="submit" name="capnhatvanchuyen" class="btn btn-success">Cập nhật vận chuyển</button>
                        <?php
                    }
                    ?>
                </form>
        
            </div>
        </div>
    </div>

    <h4>Giỏ hàng của bạn</h4>
    <table class="cart-table">
        <tr>
            <th>STT</th>
            <th>Mã sản phẩm</th>
            <th>Tên mặt hàng</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá mặt hàng</th>
            <th>Thành tiền</th>
        </tr>
        <?php
        if (isset($_SESSION['cart'])) {
            $i = 0;
            $tongtien = 0;
            foreach ($_SESSION['cart'] as $cart_item) {
                $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                $tongtien += $thanhtien;
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $cart_item['id']; ?></td>
                    <td><?php echo $cart_item['tensanpham']; ?></td>
                    <td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width="90px"></td>
                    <td>
                        <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"></a>
                        <?php echo $cart_item['soluong']; ?>
                        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"></a>
                    </td>
                    <td><?php echo number_format($cart_item['giasp']) . ' ₫'; ?></td>
                    <td><?php echo number_format($thanhtien) . ' ₫'; ?></td>
                    
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="3"><p style ="text-align:left;">Tổng tiền cho tất cả mặt hàng : </p></td>
                <td colspan="5"><p style ="text-align:right; color:red;"><?php echo number_format($tongtien).' ₫'; ?></p></td>
            </tr>
            <tr>
                <td colspan="8">
                    <?php
                    if (isset($_SESSION['dangky'])) {
                        ?>
                        <p><a href="index.php?quanly=thongtinthanhtoan"  class="btn btn-success">Thanh toán</a> <a href="index.php"  class="btn btn-success">Thêm hàng</a></p>
                        
                        <?php
                    } else {
                        ?>
                        <p>Chưa có tài khoản? <a href="index.php?quanly=dangky" class="btn btn-primary">Đăng ký đặt hàng</a></p>
                        <?php
                    }
                    ?>
                    
                </td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="8"><p>Hiện tại giỏ hàng đang trống</p></td>
            </tr>
            <?php
        }
        ?>
    </table>

</div>
<div class="arrow-steps clearfix" >
        <div class="step done"> <span><a href="index.php?quanly=giohang">Giỏ hàng</a></span> </div>
        <div class="step current"> <span><a href="index.php?quanly=vanchuyen">Vận chuyển</a> </span> </div>
        <div class="step"> <span><a href="index.php?quanly=thongtinthanhtoan"> Thanh toán</a></span> </div>
        <div class="step"> <span><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a></span> </div>
    </div>
</body>
</html>
