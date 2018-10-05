<table width="800" border="1">
  <caption>
    DANH SÁCH SẢN PHẨM<br>
    <select name="cid" onchange="window.location='?mod=product&cid='+this.value">
        <option value="0">--- Chọn loại ---</option>
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
    
    
  </caption>
  <tr>
    <th width="57" scope="row">STT</th>
    <th width="241">Tên</th>
    <th width="97">Hình</th>
    <th width="98">Giá</th>
    <th width="88">Số lượng</th>
    <th width="54">Ẩn</th>
    <th width="119"><a href="?mod=product-add&cid=<?php echo $cid ?>">+ Thêm</a></th>
  </tr>
  <?php
  	echo $sql='SELECT `id`,`name`,`price`,`qty`,`active`,`img_url` FROM `nn_product` where `category_id`='.$cid;
	$rs=mysqli_query($link,$sql);
	$i=1;
	while($r=mysqli_fetch_assoc($rs))
	{
  ?>
  <tr>
    <td align="center" scope="row"><?php echo $i++; ?></td>
    <td><?php echo $r['name']; ?></td>
    <td align="center"><img src="images/sanpham/<?php echo $r['img_url'] ?>" height="30" alt="img" /></td>
    <td align="right"><?php echo number_format($r['price']) ?></td>
    <td align="right"><?php echo $r['qty'] ?></td>
    <td align="center"><?php echo $r['active']==0?'X':'' ?></td>
    <td align="center">
    	<a href="?mod=product-upd&id=<?php echo $r['id'] ?>">Sửa</a> |     
   		 <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" href="?mod=product-del&id=<?php echo $r['id'] ?>">Xóa</a>
         | <a href="index.php?mod=detail&id=<?php echo $r['id'] ?>">Chi tiết</a>
         </td>
  </tr>
  <?php
	}
  ?>
</table>
