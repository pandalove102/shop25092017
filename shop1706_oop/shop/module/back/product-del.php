<?php
	$id=$_GET['id'];
	
	//Xoa file anh
	$sql='select `img_url`,`category_id` from `nn_product` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	
	if(is_file('images/sanpham/'.$r['img_url']))
		unlink('images/sanpham/'.$r['img_url']);
	
	//Xoa khoi DB
	$sql='delete from `nn_product` where `id`='.$id;
	mysqli_query($link,$sql);
	
	//Chuyen trang
	header('location:?mod=product&cid='.$r['category_id']);	
?>