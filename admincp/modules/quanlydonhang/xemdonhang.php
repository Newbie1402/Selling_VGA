<?php 
    $code = $_GET['code'];
    $sql_lietke_dh = "SELECT tbl_cart_details.*, tbl_sanpham.tensanpham, tbl_sanpham.giasp 
                      FROM tbl_cart_details 
                      INNER JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
                      WHERE tbl_cart_details.code_cart = '".$code."' 
                      ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>
<style>
  .button {
    display: inline-block;      
    background-color: #FFC107;  
    color: #000;                
    padding: 10px 20px;        
    text-align: center;        
    text-decoration: none;      
    border-radius: 5px;         
    font-weight: bold;        
    border: 1px solid #FFC107; 
    transition: background-color 0.3s ease; 
  }
  .button:hover {
      background-color: #FFB300; 
      color: #fff;          
  }
</style>
<p>Liệt kê đơn hàng</p>
<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Id</th>
    <th>Mã Đơn Hàng</th>
    <th>Tên Sản Phẩm</th>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
  </tr>
  <?php 
  $tongtien=0;
  $i = 0;
  while($row = mysqli_fetch_array($query_lietke_dh)){
    $i++;
    $thanhtien= $row['giasp']*$row['soluongmua'];
    $tongtien += $thanhtien;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tensanpham'] ?></td>
    <td><?php echo $row['soluongmua'] ?></td>
    <td><?php echo number_format($row['giasp'],0,',','.' ).' vnd'?></td>
    <td><?php echo number_format($thanhtien,0,',','.' ).' vnd' ?></td>
  </tr>
  <?php 
  }
  ?>
  <tr>
    <td colspan="6">
         <p>Tổng tiền: <?php echo number_format($tongtien,0,',','.' ).' vnd' ?></p>
    </td>
  </tr>
</table>
<a href="index.php?action=quanlydonhang&query=lietke" class="button">Quay lại xem đơn hàng </a>
