<?php
session_start();
include('../../admincp/config/config.php');


function redirect_to_cart() {
    header('Location: ../../index.php?quanly=giohang');
    exit();
}

// Xóa 1 sản phẩm
if(isset($_SESSION['cart']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach($_SESSION['cart'] as $key => $cart_item) {
        if($cart_item['id'] == $id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
    redirect_to_cart();
}

// Xóa toàn bộ sản phẩm trong giỏ
if(isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    redirect_to_cart();
}

// Thêm sản phẩm
if(isset($_POST['themgiohang'])) {
    $id = $_GET['idsanpham'];
    $soluong = 1;

    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham='".$id."' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

    if($row) {
        $new_product = array('tensanpham' => $row['tensanpham'], 'id' => $id, 'soluong' => $soluong, 'giasp' => $row['giasp'], 'hinhanh' => $row['hinhanh'], 'masp' => $row['masp']);

        if(isset($_SESSION['cart'])) {
            $found = false;
            foreach($_SESSION['cart'] as $key => $cart_item) {
                if($cart_item['id'] == $id) {
                    $_SESSION['cart'][$key]['soluong'] += 1;
                    $found = true;
                    break;
                }
            }
            if(!$found) {
                $_SESSION['cart'][] = $new_product;
            }
        } else {
            $_SESSION['cart'][] = $new_product;
        }
    }
    redirect_to_cart();
}

if(isset($_SESSION['cart']) && isset($_GET['cong'])) {
    $id = $_GET['cong'];
    $sql2 = "SELECT * FROM tbl_sanpham WHERE id_sanpham='".$id."' LIMIT 1";
    $query2 = mysqli_query($mysqli, $sql2);
    $row2 = mysqli_fetch_array($query2);

    foreach($_SESSION['cart'] as $key => $cart_item) {
        if($cart_item['id'] == $id) {
            if($cart_item['soluong'] < $row2['soluong']) {
                $_SESSION['cart'][$key]['soluong'] += 1;
            }
            break;
        }
    }
    redirect_to_cart();
}


if(isset($_SESSION['cart']) && isset($_GET['tru'])) {
    $id = $_GET['tru'];

    foreach($_SESSION['cart'] as $key => $cart_item) {
        if($cart_item['id'] == $id) {
            if($cart_item['soluong'] > 1) {
                $_SESSION['cart'][$key]['soluong'] -= 1;
            } else {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); 
            }
            break;
        }
    }
    redirect_to_cart();
}
?>
