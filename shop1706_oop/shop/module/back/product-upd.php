<?php
	$id=$_GET['id'];
	
	$sql='select * from `nn_product` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$rP=mysqli_fetch_assoc($rs);
	
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
		
		$img_url=$rP['img_url'];
		
		//Xu ly file
		$file=$_FILES['img_url'];		
		if($file['name']!='')//Co upload file
		{
			//Xóa file cũ (nếu có)
			if(is_file('images/sanpham/'.$rP['img_url']))
				unlink('images/sanpham/'.$rP['img_url']);
			//Lay ten file
			$img_url=mt_rand().$file['name'];
			//Copy file ve thu muc chua anh
			copy($file['tmp_name'],'images/sanpham/'.$img_url);
		}
		
		//Insert vao DB
		$sql="update `nn_product` set 		
			`category_id`='$cat_id',
			`name`='$name',
			`price`='$price',
			`desc`='$desc',
			`detail`='$detail',
			`img_url`='$img_url',
			`qty`='$qty',
			`note`='$note',
			`active`='$active'
			Where `id`=$id";
		mysqli_query($link,$sql);
		
		//Chuyen trang
		header('location:?mod=product&cid='.$cat_id);
		
	}
?>
<form action="" method="post" enctype="multipart/form-data">
    <table width="100%" border="1">
      <caption>
       CẬP NHẬT SẢN PHẨM
      </caption>
      <tr>
        <th width="134" scope="row">Loại</th>
        <td width="875">
        	<select name="cat_id" id="cat_id">
           <?php
		
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
							<option <?php if($r['id']==$rP['category_id']) echo 'selected' ?> value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
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
        <th width="134" scope="row">Tên</th>
        <td width="875"><input type="text" name="name" value="<?php echo $rP['name']?>" ></td>
      </tr>
      <tr>
        <th scope="row">Giá</th>
        <td><input type="text" name="price" id="price"  value="<?php echo $rP['price']?>" ></td>
      </tr>
      <tr>
        <th scope="row">Số lượng</th>
        <td><input type="number" name="qty" id="qty"  value="<?php echo $rP['qty']?>" ></td>
      </tr>
      <tr>
        <th scope="row">Hình</th>
        <td>
        <img src="images/sanpham/<?php echo $rP['img_url']?>" alt="img" height="100" ><br>
        <input type="file" name="img_url" id="img_url" ><br>
        <em>(Để trống nếu không muốn cập nhật hình)</em>
        </td>
      </tr>
      <tr>
        <th scope="row">Mô tả</th>
        <td><textarea class="ckeditor" name="desc" id="desc"><?php echo $rP['desc']?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Chi tiết</th>
        <td><textarea name="detail" id="detail"><?php echo $rP['detail']?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Ghi chú</th>
        <td><textarea name="note" id="note"><?php echo $rP['note']?></textarea></td>
      </tr>
      <tr>
        <th scope="row">Hiển thị</th>
        <td><input type="checkbox" <?php if($rP['active']==1) echo 'checked'?> value="1" name="active" ></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td><button type="submit"> Update </button> <button type="reset">Reset</button></td>
      </tr>
    </table>
</form>
<script type="text/javascript" src="lib/ckeditor/ckeditor.js"></script>
<script src="lib/ckfinder/ckfinder.js"></script>
<script>
	var editor=CKEDITOR.replace( 'detail', {
		uiColor: '#14B8C4',
		language:'vi',
		toolbar: [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	{ name: 'others', items: [ '-' ] },
]
	});
	
	//Gan voi CKFinder
	CKFinder.setupCKEditor( editor, 'lib/ckfinder/' ) ;
</script>
