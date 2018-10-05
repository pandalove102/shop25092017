<table width="715" border="1">
  <caption>
    DANH SÁCH LOẠI SẢN PHẨM
  </caption>
  <tr>
    <th width="46" scope="row">STT</th>
    <th width="209">Chủng loại</th>
    <th width="209">Tên loại</th>
    <th width="76">Thứ tự</th>
    <th width="63">Ẩn</th>
    <th width="72"><a href="?mod=cat-add">+ Thêm</a></th>
  </tr>
  <?php
  	$sql='SELECT a. * , b.`name` AS `dName`
			FROM `nn_category` a
			LEFT JOIN `nn_department` b ON a.`department_id` = b.`id`
			ORDER BY b.`id` , a.`order` ';
	$rs=mysqli_query($link,$sql);
	$i=1;
	while($r=mysqli_fetch_assoc($rs))
	{
  ?>
  <tr>
    <td align="center" scope="row"><?php echo $i++; ?></td>
    <td><?php echo $r['dName']; ?></td>
    <td><?php echo $r['name']; ?></td>
    <td align="center"><?php echo $r['order'] ?></td>
    <td align="center"><?php echo $r['active']==0?'X':'' ?></td>
    <td align="center"><a href="?mod=cat-upd&id=<?php echo $r['id'] ?>">Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?\nNếu xóa thì tất cả sản phẩm thuộc loại này sẽ bị xóa')" href="?mod=cat-del&id=<?php echo $r['id'] ?>">Xóa</a></td>
  </tr>
  <?php
	}
  ?>
</table>
