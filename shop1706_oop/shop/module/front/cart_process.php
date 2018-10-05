<?php
	//Lay tu session
	$cart=$_SESSION['cart'];
	
	$act=$_GET['act'];//1:Them,2:Sua,3:Xoa
	
	$id=$_GET['id'];
	
	//Them 1 san pham co $id vao gio hang
	if($act==1)
	{
		$qty=max(1,intval($_GET['qty']));
		
		$cart[$id]+=$qty;
	}
	
	if($act==2)
	{
		//print_r($_POST);
		//print_r($cart);
		//$cart=$_POST;
		foreach($cart as $k=>$v)
		{
			$cart[$k]=max(1,intval($_POST[$k]));
		}
	}
	
	
	//Xóa sản phẩm có $id khỏi giỏ hàng
	if($act==3)
	{		
		unset($cart[$id]);
	}
	
	//Cap nhat len session
	$_SESSION['cart']=$cart;
	
	//Chuyen trang
	header('location:?mod=cart');
?>