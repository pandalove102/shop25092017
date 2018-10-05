<?php
	if(isset($_POST['name']))
	{
		//print_r($_POST);
		//print_r($_FILES);
		
		$cat_id=$_POST['cat_id'];
		$name=$_POST['name'];
		$price=$_POST['price'];
		$qty=$_POST['qty'];
		$desc=$_POST['desc'];
		$detail=$_POST['detail'];
		$note=$_POST['note'];;
		$active=intval($_POST['active']);
		
		
		//Xu ly file
		$file=$_FILES['img_url'];		
		if($file['name']!='')//Co upload file
		{
			//Lay ten file
			$img_url=mt_rand().$file['name'];
			//Copy file ve thu muc chua anh
			copy($file['tmp_name'],'images/sanpham/'.$img_url);
		}
		
		//Insert vao DB
		$sql="insert into `nn_product` values (NULL,'$cat_id','$name','$price','$desc','$detail','$img_url',now(),'$qty','$note','0','0','$active')";
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=product&cid='.$cat_id);
		
	}
?>
<form action="" method="post" enctype="multipart/form-data">
    <table width="400" border="1">
      <caption>
        THÊM  SẢN PHẨM
      </caption>
      <tr>
        <th width="151" scope="row">Loại</th>
        <td width="333">
        	<select name="cat_id" id="cat_id">
           <?php
			$cid=intval($_GET['cid']);
		
            $sql='select `id`,`name` from `nn_department` where `active`=1 order by `order`';
            $rsDep=mysqli_query($link,$sql);
            while($r=mysqli_fetch_assoc($rsDep))
            {
			?>
					<optgroup label="<?php echo $r['name']?>">
					<?php
						$sql='select `id`,`name` from `nn_category` where `active`=1 AND `department_id`='.$r['id'];
						$rsCat=mysqli_query($link,$sql);
						while($r=mysqli_fetch_assoc($rsCat))
						{
					?>
							<option <?php if($r['id']==$cid) echo 'selected' ?> value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
					<?php
						}
					?>
					</optgroup>
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
        <th scope="row">Giá</th>
        <td><input type="text" name="price" id="price" ></td>
      </tr>
      <tr>
        <th scope="row">Số lượng</th>
        <td><input type="number" name="qty" id="qty" /></td>
      </tr>
      <tr>
        <th scope="row">Hình</th>
        <td><input type="file" name="img_url" id="img_url" /></td>
      </tr>
      <tr>
        <th scope="row">Mô tả</th>
        <td><textarea name="desc" id="desc"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Chi tiết</th>
        <td><textarea name="detail" id="detail"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Ghi chú</th>
        <td><textarea name="note" id="note"></textarea></td>
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
