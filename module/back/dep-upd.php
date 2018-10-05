<?php
	$id=$_GET['id'];
	

	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=intval($_POST['active']);
		
		$sql="update `nn_department` set 
			`name`='$name',
			`order`='$order',
			`active`='$active'
			where `id`=$id";
			
		
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=dep');
	}
	
	$sql='select * from `nn_department` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
?>
<form action="" method="post">
    <table width="400" border="1">
      <caption>
        THÊM CHỦNG LOẠI
      </caption>
      <tr>
        <th width="151" scope="row">Tên</th>
        <td width="333"><input type="text" name="name" value="<?php echo $r['name']?>" ></td>
      </tr>
      <tr>
        <th scope="row">Thứ tự</th>
        <td><input type="number" name="order"  value="<?php echo $r['order']?>"></td>
      </tr>
      <tr>
        <th scope="row">Hiển thị</th>
        <td><input type="checkbox" <?php if($r['active']==1) echo 'checked' ?> value="1" name="active" ></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td><button type="submit"> Update </button> <button type="reset">Reset</button></td>
      </tr>
    </table>
</form>
