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

.xemdonhang {
    width: 100%;
    margin: 20px auto;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.xemdonhang h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
}


.xemdonhang table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.xemdonhang table th, .xemdonhang table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

.xemdonhang table th {
    background-color: #4CAF50;
    color: white;
    text-transform: uppercase;
    font-weight: bold;
}

.xemdonhang table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.xemdonhang table tr:hover {
    background-color: #f1f1f1;
}

.xemdonhang table td {
    color: #333;
}


.xemdonhang table tr:last-child td {
    font-weight: bold;
    background-color: #ffe8e8;
    color: red;
    border-top: 2px solid #ddd;
}


.xemdonhang .button {
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
    margin-top: 20px;
    display: block;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
}

.xemdonhang .button:hover {
    background-color: #FFB300;
    color: #fff;
}

</style>
<div class="xemdonhang">
<h1>Chi tiết đơn hàng</h1>
<table style="width:80%" border="1" style="border-collapse: collapse;">
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


  <tr>
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
    <td><?php echo $row['code_cart'] ?></td>
    <td><?php echo $row['tensanpham'] ?></td>
    <td><?php echo $row['soluongmua'] ?></td>
    <td><?php echo number_format($row['giasp'],0,',','.' ).' đ'?></td>
    <td width="100px"><?php echo number_format($thanhtien,0,',','.' ).' đ' ?></td>
  </tr>
  <?php 
  }
  ?>
  <tr>
    <td colspan="4" style="text-align:center;">
         <p>Tổng tiền:</p>
    </td>
    <td colspan="1">
         <p style="color:red;"><?php echo number_format($tongtien,0,',','.' ).' đ' ?></p>
    </td>
  </tr>
</table>

<br>
<a href="index.php?quanly=lichsudonhang" class="button">Quay lại xem đơn hàng </a>

</div>