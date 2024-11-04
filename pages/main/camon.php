<h2>Cảm ơn bạn đã tin tưởng và lựa chọn sản phẩm của chúng tôi để đồng hành cùng các bạn. Hy vọng, sản phẩm/dịch vụ của chúng tôi sẽ giúp bạn có những trải nghiệm tuyệt vời nhất.<br>
 Rất mong bạn sẽ tiếp tục ủng hộ chúng tôi trong thời gian tới.</h2>
<br>
<?php 
if (isset($_SESSION['id_khachhang']) && $_SESSION['id_khachhang']!=13){
?>
<a href="index.php?quanly=lichsudonhang" style="background-color: #09F; padding:10px; color:white; border-radius:5px;">Xem lịch sử đơn hàng</a>
<?php 
} 
?>