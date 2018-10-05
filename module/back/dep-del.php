<?php
	$id=$_GET['id'];
	
	$sql='delete from `nn_department` where `id`='.$id;
	mysqli_query($link,$sql);
	
	//Chuyen trang
	header('location:?mod=dep');	
