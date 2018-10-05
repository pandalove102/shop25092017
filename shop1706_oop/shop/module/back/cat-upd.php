<?php
	$id=$_GET['id'];
	
	//Lay thong tin hien tai
	$sql='select * from `nn_category` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$rCat=mysqli_fetch_assoc($rs);
	
	
	if(isset($_POST['name']))
	{
		$dep_id=$_POST['dep_id'];
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=intval($_POST['active']);
		
		$sql="update `nn_category` set 
			 `department_id`='$dep_id',
			 `name`='$name',
			 `order`='$order',
			 `active`='$active'
			  WHERE `id`=$id";
			  
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=cat');
	}
?>
<form action="" method="post">
    <table width="400" border="1">
      <caption>
        CẬP NHẬP SẢN PHẨM
      </caption>
      <tr>
        <th width="151" scope="row">Chủng loại</th>
        <td width="333">
        	<select name="dep_id">
           	<?php
				$sql='select `id`,`name` from `nn_department` order by `order`';
				$rs=mysqli_query($link,$sql);
				while($r=mysqli_fetch_assoc($rs))
				{
			?>
            		<option <?php if($r['id']==$rCat['department_id']) echo 'selected' ?> value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
            <?php
				}
			?>
            </select>
        </td>
      </tr>
      <tr>
        <th width="151" scope="row">Tên</th>
        <td width="333"><input type="text" name="name" value="<?php echo $rCat['name']?>" ></td>
      </tr>
      <tr>
        <th scope="row">Thứ tự</th>
        <td><input type="number" name="order"  value="<?php echo $rCat['order']?>"></td>
      </tr>
      <tr>
        <th scope="row">Hiển thị</th>
        <td><input type="checkbox" <?php if($rCat['active']==1) echo 'checked'?> value="1" name="active" ></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td><button type="submit"> Update </button> <button type="reset">Reset</button></td>
      </tr>
    </table>
</form>
