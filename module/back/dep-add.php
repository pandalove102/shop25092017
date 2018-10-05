<?php
	if(isset($_POST['name']))
	{
		print_r($_POST);
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=intval($_POST['active']);
		
		$sql="insert into `nn_department` values (NULL,'$name','$order','$active')";
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=dep');
	}
?>
<form action="" method="post">
    <table width="400" border="1">
      <caption>
        THÊM CHỦNG LOẠI
      </caption>
      <tr>
        <th width="151" scope="row">Tên</th>
        <td width="333"><input type="text" name="name" ></td>
      </tr>
      <tr>
        <th scope="row">Thứ tự</th>
        <td><input type="number" name="order" ></td>
      </tr>
      <tr>
        <th scope="row">Hiển thị</th>
        <td><input type="checkbox" checked="checked" value="1" name="active" ></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td><button type="submit"> Add </button> <button type="reset">Reset</button></td>
      </tr>
    </table>
</form>
