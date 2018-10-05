<?php
	//print_r($_POST);
	$content=$_POST['content'];
	$product_id=$_POST['product_id'];
	$user_id=$_SESSION['id'];
	$star=$_POST['star'];
	
	$sql="insert into `nn_comment` values(NULL,'$product_id','$user_id','$content','$star',now())";
	mysqli_query($link,$sql);
	
	//Chuyen den trang chi tiet
	header('location:?mod=detail&id='.$product_id);
	
?>