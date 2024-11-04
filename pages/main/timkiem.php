        <!-- main content -->
        <div class="main">
            <ul class="list_main">

            <?php
                // Kết nối cơ sở dữ liệu
                if(isset($_POST['timkiem'])){
                    $tukhoa= $_POST['tukhoa'];
                }
                // Truy vấn lấy sản phẩm theo danh mục
                $sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE '%".$tukhoa."%'";
                
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
            <h3>Tìm kiếm cho từ khoá:<?php echo $_POST['tukhoa']; ?></h3>   
                
            <?php 
                foreach ($products as $row_pro) 
                { 
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