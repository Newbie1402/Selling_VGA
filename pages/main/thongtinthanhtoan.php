<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin thanh toán</title>
    <style>
        .container {
            margin: 20px;
            float:right;
            width: 80%;
        }

        .arrow-steps {
            margin-bottom: 20px;
        }

        .arrow-steps .step {
            display: inline-block;
            padding: 10px 20px;
            background: #ddd;
            border-radius: 4px;
            margin-right: 10px;
            position: relative;
        }

        .arrow-steps .step.done {
            background: #4caf50;
        }

        .arrow-steps .step.current {
            background: #ff9800;
        }

        .arrow-steps .step span a {
            text-decoration: none;
            color: #000;
        }

        h4, h5 {
            margin-top: 20px;
        }

/* Định dạng bảng giỏ hàng */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 5px;
    overflow: hidden;
}

.cart-table th, .cart-table td {
    border: 3px solid #ddd;
    padding: 10px;
    text-align: center;
    font-size: 14px;
    color: #333;
}

.cart-table th {
    background-color: #f4f4f4;
    font-weight: bold;
    text-transform: uppercase;
}

.cart-table td img {
    width: 90px;
    border-radius: 4px;
    transition: transform 0.3s ease;
}

.cart-table td img:hover {
    transform: scale(1.05);
}

.cart-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.cart-table tr:hover {
    background-color: #f1f1f1;
}

.cart-table .total-row td {
    font-weight: bold;
    color: red;
    text-align: right;
}

.cart-table .empty-cart {
    text-align: center;
    color: #777;
    font-style: italic;
    padding: 20px;
}


        .form-check {
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            text-align: center;
        }

        .btn-danger {
            background-color: #d9534f;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col-md-8 {
            width: 78%;
        }

        .col-md-4 {
            width: 20%;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="arrow-steps clearfix">
        <div class="step done"> <span><a href="index.php?quanly=giohang">Giỏ hàng</a></span> </div>
        <div class="step done"> <span><a href="index.php?quanly=vanchuyen">Vận chuyển</a> </span> </div>
        <div class="step current"> <span><a href="index.php?quanly=thongtinthanhtoan"> Thanh toán</a></span> </div>
        <div class="step"> <span><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a></span> </div>
    </div>

    <form action="pages/main/xulythanhtoan.php" method="POST">
        <div class="row">
            <div class="col-md-8">
                <h4>Thông tin vận chuyển và giỏ hàng</h4>
                <?php
                $id_dangky = $_SESSION['id_khachhang'];
                $sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
                $count = mysqli_num_rows($sql_get_vanchuyen);
                if ($count > 0) {
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
                <ul>
                    <li>Họ và tên: <b><?php echo $name ?></b></li>
                    <li>Số điện thoại: <b><?php echo $phone ?></b></li>
                    <li>Địa chỉ: <b><?php echo $address ?></b></li>
                    <li>Ghi chú: <b><?php echo $note ?></b></li>
                </ul>

                <h5>Giỏ hàng của bạn</h5>
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
                                <td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>"
                                         width="90px"></td>
                                <td width="80px">
                                    <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"></a>
                                    <?php echo $cart_item['soluong']; ?>
                                    <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"></a>
                                </td>
                                <td width="150px"><?php echo number_format($cart_item['giasp']) . ' ₫'; ?></td>
                                <td width="150px"><?php echo number_format($thanhtien) . ' ₫'; ?></td>
                                
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="6"><p style ="text-align:ceter;">Tổng tiền cho tất cả mặt hàng : </p></td>
                            <td colspan="1"><p style ="text-align:center; color:red;"><?php echo number_format($tongtien).' ₫'; ?></p></td>
                        </tr>
                        <tr>
                            <td colspan="8"><p style ="text-align:center;"><a href="index.php"  class="btn btn-success">Thêm hàng</a></p></td>
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

            <div class="col-md-4">
            <h4>Phương thức thanh toán</h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="Tiền mặt" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    COD-Thanh toán khi nhận hàng
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2" value="Chuyển khoản">
                <label class="form-check-label" for="flexRadioDefault2">
                    Chuyển khoản
                </label>
                <img id="transferImage" src="image/IMG_3994.jpg" alt="TK" style="
                    display: none; 
                    margin: 10px auto 0;
                    width: 200px;
                    height: 200px;">
            </div>

            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <input type="submit" value="Thanh toán ngay" name="thanhtoanngay" class="btn btn-danger">
            </div>
        </div>

        <script>
            document.getElementById('flexRadioDefault2').addEventListener('change', function() {
                document.getElementById('transferImage').style.display = 'block';
            });

            document.getElementById('flexRadioDefault1').addEventListener('change', function() {
                document.getElementById('transferImage').style.display = 'none';
            });
        </script>


                </div>
                
            </div>
        </div>
    </form>
</div>
</body>
</html>
