<?php
    // Kết nối cơ sở dữ liệu

    // Truy vấn lấy sản phẩm theo danh mục
    $sql_pro = "SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc 
                FROM tbl_danhmuc 
                INNER JOIN tbl_sanpham ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                WHERE tbl_sanpham.id_danhmuc ='$_GET[id]' 
                ORDER BY tbl_sanpham.id_sanpham DESC";
    
    $query_pro = mysqli_query($mysqli, $sql_pro);

    // Lưu tất cả kết quả truy vấn vào một mảng
    $products = [];
    while ($row = mysqli_fetch_array($query_pro)) {
        $products[] = $row;
    }

    // Lấy tên danh mục từ kết quả đầu tiên
    if (count($products) > 0) {
        $row_title = $products[0];
    } else {
        $row_title = ['tendanhmuc' => 'Hiện tại trống.'];
    }
?>


<div class=main>
<h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc'] ?></h3>
<ul class="list_main">
    <?php 
    foreach ($products as $row_pro) { 
        $gia_sp = str_replace('.', '', $row_pro['giasp']);
    ?>
    <li>
        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
            <img src="admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" alt="<?php echo $row_pro['tensanpham']; ?>">
            <h4>Tên sản phẩm: <?php echo $row_pro['tensanpham']; ?></h4>
            <p>Giá: <?php echo number_format($gia_sp).' ₫'; ?></p>
        </a>
    </li>
    <?php
    }
    ?>        
</ul>
</div>

