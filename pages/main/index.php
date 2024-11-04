<!-- main content -->
<div class="main">
    <ul class="list_main">
    <?php
        if (isset($_GET['trang'])) {
            $page = $_GET['trang'];
        } else {
            $page = '';
        }

        $begin = ($page == '' || $page == 1) ? 0 : ($page * 12) - 12;

        // Kết nối cơ sở dữ liệu
        // Truy vấn lấy sản phẩm theo danh mục
        $sql_pro = "SELECT tbl_sanpham.*, tbl_danhmuc.tendanhmuc 
                    FROM tbl_danhmuc 
                    INNER JOIN tbl_sanpham ON tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc 
                    ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin,12";
        
        $query_pro = mysqli_query($mysqli, $sql_pro);

        // Lưu tất cả kết quả truy vấn vào một mảng
        $products = [];
        while ($row = mysqli_fetch_array($query_pro)) {
            $products[] = $row;
        }

        foreach ($products as $row_pro) {
            $gia_sp = str_replace('.', '', $row_pro['giasp']);
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" alt="<?php echo $row_pro['tensanpham']; ?>">
                <h4><?php echo $row_pro['tensanpham']; ?></h4>
                <p>Giá: <?php echo number_format($gia_sp).'₫'; ?></p>
            </a>
            <div class="popup">
                <img src="admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" alt="<?php echo $row_pro['tensanpham']; ?>" style="width: 100%; height: auto;">
                <h3><?php echo $row_pro['tensanpham']; ?></h3>
                <p>Giá: <b style="color:black"><?php echo number_format($gia_sp).'₫'; ?><b></p>
                <p>Hãng: <b style="color:black"><?php echo $row_pro['tendanhmuc']; ?></b></p>
                <p>Bảo hành: <b style="color:black"><?php echo $row_pro['masp']; ?></b></p>
                <p>Tình trạng: 
                <?php 
                if ($row_pro['soluong'] > 0) {
                    echo '<span style="color: green;">Còn hàng</span>';
                } else {
                    echo "Hết hàng";
                }
                ?>
                </p>

            </div>
        </li>
    <?php
        }
    ?>
    </ul>
    <div style="clear: both;"></div>

    <style type="text/css">
        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 2px solid black;
            border-radius: 5px;
            margin-left: 6px;
            box-shadow: 2px 2px #00A4BD, 3px 3px #FF7A59;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
    <br>
    <?php
    //đếm số lượng sản phẩm
    $spl_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham");
    $row_count = mysqli_num_rows($spl_trang);
    $trang = ceil($row_count / 12);
    ?>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $trang; $i++) {
        ?>
            <a href="index.php?trang=<?php echo $i ?>" <?php echo ($page == $i) ? 'class="active"' : ''; ?>><?php echo $i ?></a>
        <?php
        }
        ?>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* .list_main li {
            float: left;
            width: 23%;
            margin: 1%;
            position: relative;
        }

        .list_main li img {
            width: 100%;
        }

        .list_main li h4 {
            text-align: center;
            font-weight: bold;
            margin: 5px 0;
        }

        .list_main li p {
            text-align: center;
            margin: 5px 0;
        } */

        .popup {
            position: absolute;
            top: 0;
            left: 0;
            width: 250px;
            height: auto;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 10;
        }

        .popup img {
            width: 100%;
            height: auto;
        }

        .popup h3 {
            text-align: center;
            margin: 10px 0;
        }

        .popup p {
            text-align: center;
            margin: 10px 0;
        }

        .popup .button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .list_main li:hover .popup {
            display: block;
        }
    </style>
</head>
<body>
    <div class="main">
        <ul class="list_main">
            <?php
            foreach ($products as $row_pro) {
                $gia_sp = str_replace('.', '', $row_pro['giasp']);
            ?>

            <?php
            }
            ?>
        </ul>
        <div style="clear: both;"></div>
    </div>

    <script>
        document.querySelectorAll('.list_main li').forEach(item => {
    item.addEventListener('mousemove', (e) => {
        const popup = item.querySelector('.popup');
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        const popupWidth = popup.offsetWidth;
        const popupHeight = popup.offsetHeight;
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;

        
        let left = mouseX - popupWidth - 10; 
        let top = mouseY; 
 
        if (left < 0) {
            left = mouseX + 20;
        }
        /* if (right < 0) {
            right = mouseX - 20;
        } */
        
        if (top + popupHeight > screenHeight) {
            top = mouseY - popupHeight; 
        }

        if (top < 0) {
            top = 0;
        }

        popup.style.left = `${left}px`;
        popup.style.top = `${top}px`;
    });

    item.addEventListener('mouseleave', () => {
        const popup = item.querySelector('.popup');
        popup.style.left = `-100px`; 
        popup.style.top = `-100px`;
    });
});

    </script>
    
</body>
</html>
