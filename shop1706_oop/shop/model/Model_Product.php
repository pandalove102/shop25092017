<?php
include_once('Model.php');
class Product extends Model
{
	protected $table='nn_product';
	function __construct()
	{
		//echo 'Doi tuong duoc tao ra';
	}
	function countProduct($cid)
	{
		global $link;//Su dung bien toan cuc $link
		$sql="select count(*) from `nn_product` where `category_id`=$cid";
		$rs=mysqli_query($link,$sql);
		$r=mysqli_fetch_row($rs);
		return $r[0];
	}
	
	function getAll($cond,$order,$pos)
	{
		global $link;
		echo $sql="select `id`,`name`,`img_url`,`price` 
					from `nn_product` 
					where $cond
					order by $order
					limit $pos,20";
		$rs=mysqli_query($link,$sql);
		return $rs;
	}
}
?>