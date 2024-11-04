<?php 
    $id_khachhang = $_SESSION['id_khachhang'];
    $sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky AND tbl_cart.id_khachhang='$id_khachhang' ORDER BY tbl_cart.id_cart DESC";
    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<style>
/* Định dạng phần lsdonhang */
.lsdonhang {
    float:right;
    width: 84%;
    margin: auto;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.lsdonhang h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.lsdonhang table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.lsdonhang table th, .lsdonhang table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

.lsdonhang table th {
    background-color: #4CAF50;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
}

.lsdonhang table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.lsdonhang table tr:hover {
    background-color: #e9e9e9;
}

.lsdonhang table td a {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.lsdonhang table td a:hover {
    color: #0056b3;
}

.lsdonhang table td span {
    font-weight: bold;
}

.lsdonhang table td span[style*="color: red;"] {
    color: #d9534f;
}

.lsdonhang table td span[style*="color: green;"] {
    color: #28a745;
}



</style>
<div class="lsdonhang">
<h1>Lịch sử đơn hàng</h1>

<table style="width:85%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Id</th>
    <th>Mã Đơn Hàng</th>
    <th>Tên khách hàng</th>
    <th>Địa chỉ</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Chờ xác nhận</th>
    <th>Chờ giao hàng</th>
    <!-- <th>Giao hàng thành công</th> -->
    <th>Chi tiết đơn hàng</th>
    <th>Hình thức thanh toán</th>
    
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

    <td id="cart_status_<?php echo $row['code_cart']; ?>">
    <?php if ($row['cart_status'] == 1): ?>
        <a  onclick="updateCartStatus('<?php echo $row['code_cart']; ?>')">Chờ xác nhận</a>
    <?php else: ?>
        <span style="color: red;">Đã xác nhận ✓</span>
    <?php endif; ?>
</td>
<td id="shipping_a_<?php echo $row['code_cart']; ?>">
    <?php if ($row['shipping_a'] == 0): ?>
        <a onclick="updateShippingStatus('<?php echo $row['code_cart']; ?>', 'shipping_a')">Đang giao hàng</a>
    <?php else: ?>
        <span style="color: green;">Đã nhận hàng</span>
    <?php endif; ?>
</td>
<!-- <td id="shipping_b_<?php echo $row['code_cart']; ?>">
    <?php if ($row['shipping_b'] == 0): ?>
        <a href="#" onclick="updateShippingStatus('<?php echo $row['code_cart']; ?>', 'shipping_b')">Đơn hàng mới</a>
    <?php else: ?>
        <span style="color: green;">DM</span>
    <?php endif; ?>
</td> -->

<script>
function updateCartStatus(code) {
    $.ajax({
        url: 'modules/quanlydonhang/xuly.php',
        type: 'GET',
        data: {code: code, action: 'update_cart_status'},
        success: function(response) {
            $('#cart_status_' + code).html('<span style="color: red;">DONE ✓</span>');
        }
    });
}

function updateShippingStatus(code, shippingType) {
    $.ajax({
        url: 'modules/quanlydonhang/xuly.php',
        type: 'GET',
        data: {code: code, action: 'update_' + shippingType},
        success: function(response) {
            $('#'+ shippingType +'_' + code).html('<span style="color: green;">DM</span>');
        }
    });
}
</script>

    <td>
        <a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a> 
    </td>
    <td><?php echo $row['cart_payment'] ?></td>
  </tr>
  <?php 
  }
  ?>
</table>
</div>
