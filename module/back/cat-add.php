<?php
	if(isset($_POST['name']))
	{
		$dep_id=$_POST['dep_id'];
		$name=$_POST['name'];
		$order=$_POST['order'];
		$active=intval($_POST['active']);
		
		$sql="insert into `nn_category` values (NULL,'$dep_id','$name','$order','$active')";
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=cat');
	}
?>
<form action="" method="post">
    <table width="400" border="1">
      <caption>
        THÊM LOẠI SẢN PHẨM
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
            		<option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
            <?php
				}
			?>
            </select>
        </td>
      </tr>
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
