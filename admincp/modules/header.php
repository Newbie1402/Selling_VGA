<?php
    if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1)
    {
        unset($_SESSION['dangnhap']);
        header('Location:login.php');
    }
?>


<p><li style="list-style:none; margin-left:20px; text-decoration: none; border:1px solid pink; width:75px;background-color: pink;padding:10px; color:black; border-radius:10px"><a href="index.php?dangxuat=1">Đăng xuất<?php if(!isset($_SESSION['dangnhap'])) { echo $_SESSION['dangnhap'];} ?></a></li></p>