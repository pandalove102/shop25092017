<?php
include_once('Model.php');
class Category extends Model
{
	protected $table='nn_category';
	function getAll($cond,$order)
	{
		global $link;//Su dung bien toan cuc $link
		$sqlCate="select `id`,`name` from `nn_category` 
					where $cond
					order by $order";
		$rsCate=mysqli_query($link,$sqlCate);
		return $rsCate;
	}
}
?>