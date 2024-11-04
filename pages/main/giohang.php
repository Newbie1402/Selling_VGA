<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <script type="text/javascript">
        function confirmOrUpdateQuantity(url, quantity) {
            if (quantity > 1) {
                window.location.href = url;
            } else {
                if (confirm("Bạn có chắc muốn xoá sản phẩm này không?")) {
                    window.location.href = url;
                }
            }
        }

        function confirmDeletion(url, message) {
            if (confirm(message)) {
                window.location.href = url;
            }
        }
    </script>

<style>


        .giohang {
            width: 84%;
            float:right;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .giohang table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .giohang table th,
        .giohang table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .giohang table th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
        }

        .giohang table tr:hover {
            background-color: #f1f1f1;
        }

        .giohang img {
            max-width: 90px;
            border-radius: 8px;
        }

        .giohang a {
            text-decoration: none;

            transition: color 0.3s ease;
        }

        .giohang a:hover {
            color: #0056b3;
        }


        .giohang .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .total-row {
            font-weight: bold;
            font-size: 18px;
            color: red;
        }

        .text-center {
            text-align: center;
        }


    </style>
</head>
<body>
<div class="giohang">
    <table style="border-collapse: collapse; width: 100%; text-align: center;" >
        <tr>
            <td colspan="8">
                
                    <?php if (isset($_SESSION['dangky'])) { ?>
                        <p>Xin chào:<strong style="color: green;">
                       <?php echo $_SESSION['dangky'];
                    } ?>
                </strong></p>
            </td>
        </tr>

        <div class="wra">
            <div class="arrow-steps clearfix">
                <div class="step current"> <span><a href="index.php?quanly=giohang">Giỏ hàng</a></span> </div>
                <div class="step done"> <span><a href="#">Vận chuyển</a> </span> </div>
                <div class="step done"> <span><a>Thanh toán</a></span> </div>
                <div class="step done"> <span><a href="#">Lịch sử đơn hàng</a></span> </div>
            </div>
            <br> <br>
        </div>

        <tr>
            <th>STT</th>
            <th>Mã sản phẩm</th>
            <th>Tên mặt hàng</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá mặt hàng</th>
            <th>Thành tiền</th>
            <th>Xóa mặt hàng</th>
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
                    <td width="300px"><?php echo $cart_item['tensanpham']; ?></td>
                    <td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width="90px"></td>
                    <td>
                        <a href="javascript:void(0);" onclick="confirmOrUpdateQuantity('pages/main/themgiohang.php?tru=<?php echo $cart_item['id']; ?>', <?php echo $cart_item['soluong']; ?>)">
                            <i class="fa-regular fa-square-minus"></i>
                        </a>
                        <?php echo $cart_item['soluong']; ?>
                        <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>">
                            <i class="fa-regular fa-square-plus"></i>
                        </a>
                    </td>
                    <td width="auto"><?php echo number_format($cart_item['giasp']) . ' ₫'; ?></td>
                    <td width="auto"><?php echo number_format($thanhtien) . ' ₫'; ?></td>
                    <td width="120px">
                        <a  href="javascript:void(0);" onclick="confirmDeletion('pages/main/themgiohang.php?xoa=<?php echo $cart_item['id']; ?>', 'Bạn có chắc muốn xoá sản phẩm này không?')" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr style="border;">
                <td colspan="6"><p style="text-align: center;">Tổng tiền cho tất cả mặt hàng:</p></td>
                <td colspan="1"><p style="text-align: center; color: red;"><?php echo number_format($tongtien) . ' ₫'; ?></p></td>
                <td colspan="1"><p></p></td>
            </tr>
            <tr>
            <td colspan="2"><p></p></td>
                <td colspan="1">
                    <?php
                    if (isset($_SESSION['dangky'])) {
                        ?>
                        <p><a href="index.php?quanly=vanchuyen" class="btn btn-success">Đặt hàng</a></p>
                        <?php
                    } else {
                        ?>
                        <p>Chưa có tài khoản?<a href="index.php?quanly=dangky"> Đăng ký đặt hàng </a></p>
                        <?php
                    }
                    ?>
                </td>
                <td colspan="1"><p><a href="index.php" class="btn btn-success">Thêm hàng</a></p></td>
                <td colspan="2">
                    <p>
                        <a href="javascript:void(0);" 
                           onclick="confirmDeletion('pages/main/themgiohang.php?xoatatca=1', 'Bạn có chắc muốn xoá tất cả sản phẩm trong giỏ hàng không?')"
                           class="btn btn-danger">Xóa tất cả sản phẩm trong giỏ hàng</a>
                    </p>
                </td>
                <td colspan="2"><p></p></td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="8"><p>Hiện tại giỏ hàng đang trống</p></td>
            </tr>
            <?php
        }
        /* session_destroy(); */
        ?>
    </table>
</div>
</body>
</html>
