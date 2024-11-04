<!--  menu -->
<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangky']);
    unset($_SESSION['cart']);
    /* header('Location:../dangnhap.php'); */
}

if (isset($_SESSION['cart'])) {
    $soluong =0;
    foreach ($_SESSION['cart'] as $cart_item) 
    {
        $soluong+= $cart_item['soluong'];
    }
    }
else {
    $soluong = 0;
}

$sql_danhmuc= "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);




?>

<div class="menu">
    <ul class="list_menu">
        <li id="logo">
            <p><a href="index.php"><img src="image/LogoHTVGA.png" width="150px" height="40px"></a></p>
        </li>
        <div class="nav-right">
                <li id="search">
                    <form action="index.php?quanly=timkiem" method="POST">
                        <input type="search" placeholder="Tên sản phẩm" name="tukhoa" aria-label="Search" class="search-input">
                        <button type="submit" name="timkiem"  class="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </li>

            <li><a href="index.php?quanly=lienhe"><i class="fa-solid fa-phone"></i> Liên hệ</a></li>
            <li><a href="index.php?quanly=giohang"><i class="fa-solid fa-cart-shopping"></i> Giỏ hàng (<?php echo $soluong ?>)</a></li>
            <li>
                <a href="#"><i class="fa-solid fa-user"></i> Tài khoản</a>
                <ul>
                    <?php if (!isset($_SESSION['dangky'])) { ?>
                        <li><a href="index.php?quanly=dangnhap"><i class="fa-solid fa-right-from-bracket"></i> Đăng nhập</a></li>
                        <li><a href="index.php?quanly=dangky"><i class="fa-solid fa-registered"></i> Đăng ký</a></li>
                    <?php } ?>
                        
                    
                    <?php if (isset($_SESSION['dangky']) && $_SESSION['dangky']!='GUEST') { ?>
                        <li><p style="margin:1px;">Xin chào: <strong style="color: green; "> <?php if(isset($_SESSION['dangky'])) 
                            { 
                                echo $_SESSION['dangky'];
                            } 
                            ?></strong></p>
                        </li>
                        <li class="nav-item"><a href="index.php?quanly=lichsudonhang"><i class="fa-solid fa-wallet"></i> Đơn hàng</a></li>                                                                                                                                                                                                                                                                                                                                 
                        <li class="nav-item"><a href="index.php?dangxuat=1"><i class="fa-solid fa-right-to-bracket"></i> Đăng xuất</a></li>
                    <?php } 
                    else if (isset($_SESSION['dangky']) && $_SESSION['dangky']=='GUEST'){
                        ?>
                            <li><p style="margin:1px;">Xin chào: <strong style="color: green; "> <?php if(isset($_SESSION['dangky'])) 
                            { 
                                echo $_SESSION['dangky'];
                            } 
                            ?></strong></p>
                        </li>                                                                                                                                                                                                                                                                                                                               
                        <li class="nav-item"><a href="index.php?dangxuat=1"><i class="fa-solid fa-right-to-bracket"></i> Đăng xuất</a></li>
                    <?php
                    }
                    ?>
                    
                    <li><a href="admincp/login.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng nhập admin</a></li>
                </ul>
            </li>
            <?php if (isset($_SESSION['dangky'])) { ?>
            <!-- <li class="nav-item"><a href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a></li> -->
            <?php } ?>
        </div>
    </ul>
</div>



