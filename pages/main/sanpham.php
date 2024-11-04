
<br>
<?php
    $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc 
                    WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                    AND tbl_sanpham.id_sanpham='$_GET[id]' 
                    LIMIT 1" ;
    $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
    


    while($row_chitiet = mysqli_fetch_array($query_chitiet))
    {
?>  
<div class="clear"></div>
<div class="list_main">
<div class="wrapper_chitiet">
    
        <div class="hinhanh"> 
            <img src="admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh']; ?>">

        </div>
    <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
    <div>
        <div class="noidung"> 
            <h2><?php echo $row_chitiet['tensanpham'] ;?></h2>
        </div>
        <div class="gia"> 
            <h3> <?php echo number_format($row_chitiet['giasp']).' ₫'; ?></h3>
        </div>
            <p>Số lượng: <strong><?php echo $row_chitiet['soluong'] ;?> sản phầm</strong></p>
            <p>Hãng: <strong> <?php echo $row_chitiet['tendanhmuc'] ;?> </strong></p>
            <p>Bảo hành: <strong> <?php echo $row_chitiet['masp'] ;?> </strong></p>
            <?php
            if($row_chitiet['soluong'] >0){
            ?>       
            <p class="themgiohang"><input  name="themgiohang" type="submit" value="Thêm vào giỏ hàng"></p>
            <?php 
            }else{
            ?>
            <span style="color: red">Sản phẩm đang hết hàng</span>
            <?php
            }
            ?>
    </div>    
        
<div class="tabs">
  <ul id="tabs-nav">
    <li><a href="#tab1">Thông số kĩ thuật</a></li>
    <li><a href="#tab2">Nội Dung</a></li>
    
    
  </ul> <!-- END tabs-nav -->
  <div id="tabs-content">
    <div id="tab1" class="tab-content">
        <?php echo $row_chitiet['tomtat'] ;?>
    </div>
    <div id="tab2" class="tab-content">
        <?php echo $row_chitiet['noidung'] ;?>
    </div>
    
    
  </div> <!-- END tabs-content -->
</div> <!-- END tabs -->
    </form>
</div>
</div>

<?php
    }
?>