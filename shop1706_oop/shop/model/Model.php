<?php
class Model
{
	protected $table;

	function get($id)
	{
		global $link;
		$sql='select * from `'.$this->table.'` where `id`='.$id;
		$rs=mysqli_query($link,$sql);
		$r=mysqli_fetch_assoc($rs);
		return $r;
	}
}
?>