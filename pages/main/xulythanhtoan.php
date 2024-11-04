<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("../../admincp/config/config.php");

$id_khachhang = $_SESSION['id_khachhang'];
$code_order = rand(0, 9999);
$cart_payment = $_POST['payment'];
$id_dangky = $_SESSION['id_khachhang'];

$sql_get_vanchuyen = mysqli_query($mysqli, "SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1");
$row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
$id_shipping = $row_get_vanchuyen['id_shipping'];

$insert_cart = "INSERT INTO tbl_cart (id_khachhang, code_cart, cart_status, cart_payment, cart_shipping) 
                VALUES ('$id_khachhang', '$code_order', 1, '$cart_payment', '$id_shipping')";
$cart_query = mysqli_query($mysqli, $insert_cart);

if ($cart_query) {

    foreach ($_SESSION['cart'] as $key => $value) {
        $id_sanpham = $value['id'];
        $soluong = $value['soluong'];
        $giamua = isset($value['giamua']) ? $value['giamua'] : 0; 

        $insert_order_detail = "INSERT INTO tbl_cart_details (id_sanpham, code_cart, soluongmua, giamua) 
                                VALUES ('$id_sanpham', '$code_order', '$soluong', '$giamua')";
        mysqli_query($mysqli, $insert_order_detail);

        $sql_chitiet = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id_sanpham' LIMIT 1";
        $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
        $row_chitiet = mysqli_fetch_array($query_chitiet);

        $soluongtong = $row_chitiet['soluong'];
        $soluongcon = $soluongtong - $soluong;
        $soluongbanra = $soluong + $row_chitiet['soluongban'];

        $sql_update_sl = "UPDATE tbl_sanpham 
                          SET soluong = '$soluongcon', soluongban = '$soluongbanra' 
                          WHERE id_sanpham = '$id_sanpham'";
        mysqli_query($mysqli, $sql_update_sl);
    }
}

unset($_SESSION['cart']);
header('Location: ../../index.php?quanly=camon');
?>
