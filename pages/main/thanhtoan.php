<?php
    session_start();
    include("../../admincp/config/config.php");
    $id_khachhang = $_SESSION['id_khachhang'];
    $code_order = rand(0,9999);
    $insert_cart= "INSERT INTO tbl_cart (id_khachhang, code_cart, cart_status) VALUES ('".$id_khachhang."','".$code_order."',1)";
    $cart_query = mysqli_query($mysqli,$insert_cart);
    if($cart_query){
        foreach($_SESSION['cart'] as $key => $value){
            $id_sanpham = $value['id'];
            $soluong = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_cart_details (id_sanpham, code_cart, soluongmua) VALUES ('".$id_sanpham."','".$code_order."','".$soluong."')";
            mysqli_query($mysqli,$insert_order_detail);
        }
    
    }
    unset($_SESSION['cart']);
    header('location:../../index.php?quanly=camon');
?>