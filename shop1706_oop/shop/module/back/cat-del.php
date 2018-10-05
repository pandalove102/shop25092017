<?php
	$id=$_GET['id'];//id loai can xoa
	
	/*
		Xoa cac san pham thuoc loai nay
	*/
	
	//Xóa hình
	$sql='select `img_url`,`category_id` from `nn_product` where `category_id`='.$id;
	$rs=mysqli_query($link,$sql);
	while($r=mysqli_fetch_assoc($rs))
	{
		if(is_file('images/sanpham/'.$r['img_url']))
			unlink('images/sanpham/'.$r['img_url']);
	}
	
	//Xoa SP khoi DB
	$sql='delete from `nn_product` where `category_id`='.$id;
	mysqli_query($link,$sql);
	
	/*
		End of Xoa cac san pham thuoc loai nay
	*/
	
	//Xoa loai SP sap khoi DB
	$sql='delete from `nn_category` where `id`='.$id;
	mysqli_query($link,$sql);
	
	//Chuyen trang
	header('location:?mod=cat');	
?>