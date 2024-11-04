<?php 
    include('../../config/config.php');

    if (isset($_GET['code']) && isset($_GET['action'])) {
        $code_cart = $_GET['code'];
        $action = $_GET['action'];
        if ($action == 'update_cart_status') {
            $sql = "UPDATE tbl_cart SET cart_status = 0 WHERE code_cart = '".$code_cart."'";
        } elseif ($action == 'update_shipping_a') {
            $sql = "UPDATE tbl_cart SET shipping_a = 1 WHERE code_cart = '".$code_cart."'";
        } elseif ($action == 'update_shipping_b') {
            $sql = "UPDATE tbl_cart SET cart_status = 0, shipping_a = 1, shipping_b = 1 WHERE code_cart = '".$code_cart."'";
        }
        $query = mysqli_query($mysqli, $sql);
        if ($query) {
            header('Location: ../../index.php?action=quanlydonhang&query=lietke');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }
?>
