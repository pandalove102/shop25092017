<?php
	if(!isset($_SESSION['id']))header('location:?mod=login');
	
	$idUser=$_SESSION['id'];
	$idOrder=$_GET['id'];

	$sql="update `nn_order` set `status`=-1 where `status`=0 AND `id`=$idOrder AND `user_id`=$idUser";
	mysqli_query($link,$sql);
	
	//Chuyen den trang account
	header('location:?mod=account');
	

?>	
