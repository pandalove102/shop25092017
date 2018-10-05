<table width="500" border="1">
  <caption>
    DANH SÁCH CHỦNG LOẠI
  </caption>
  <tr>
    <th width="46" scope="row">STT</th>
    <th width="209">Tên</th>
    <th width="76">Thứ tự</th>
    <th width="63">Ẩn</th>
    <th width="72"><a href="?mod=dep-add">+ Thêm</a></th>
  </tr>
  <?php
  	$sql='SELECT * FROM `nn_department` order by `order`';
	$rs=mysqli_query($link,$sql);
	$i=1;
	while($r=mysqli_fetch_assoc($rs))
	{
  ?>
  <tr>
    <td align="center" scope="row"><?php echo $i++; ?></td>
    <td><?php echo $r['name']; ?></td>
    <td align="center"><?php echo $r['order'] ?></td>
    <td align="center"><?php echo $r['active']==0?'X':'' ?></td>
    <td align="center"><a href="?mod=dep-upd&id=<?php echo $r['id'] ?>">Sửa</a> | <a onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')" href="?mod=dep-del&id=<?php echo $r['id'] ?>">Xóa</a></td>
  </tr>
  <?php
	}
  ?>
</table>
