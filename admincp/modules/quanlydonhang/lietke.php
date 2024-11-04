<?php 
    $sql_lietke_dh = "SELECT tbl_cart.*, tbl_dangky.tenkhachhang, tbl_dangky.diachi, tbl_dangky.email, tbl_dangky.dienthoai 
                      FROM tbl_cart 
                      INNER JOIN tbl_dangky ON tbl_cart.id_khachhang = tbl_dangky.id_dangky 
                      ORDER BY tbl_cart.id_cart DESC";
    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<p>Liệt kê đơn hàng</p>
<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Id</th>
    <th>Mã Đơn Hàng</th>
    <th>Tên Khách Hàng</th>
    <th>Địa chỉ</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Chờ xác nhận</th>
    <th>Chờ giao hàng</th>
    <th>Đã giao</th>
    <th>Quản lý</th>
  </tr>
  <?php 
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_dh)){
    $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tenkhachhang'] ?></td>
    <td><?php echo $row['diachi'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['dienthoai'] ?></td>
    <td>
    <?php
    if($row['cart_status'] == 1) {
        echo '<a href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&action=update_cart_status">Đơn hàng mới</a>';
    } else {
        echo 'DONE ✓';
    }
    ?>
</td>
<td>
    <?php
    if($row['shipping_a'] == 0) {
        echo '<a href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&action=update_shipping_a">Đơn hàng mới</a>';
    } else {
        echo 'DONE';
    }
    ?>
</td>
<td>
    <?php
    if($row['shipping_b'] == 0) {
        echo '<a href="modules/quanlydonhang/xuly.php?code=' . $row['code_cart'] . '&action=update_shipping_b">Đơn hàng mới</a>';
    } else {
        echo 'DONE';
    }
    ?>
</td>

    <td>
        <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a> 
    </td>
  </tr>
  <?php 
  }
  ?>
</table>
