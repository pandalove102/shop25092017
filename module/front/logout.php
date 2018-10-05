<?php
	//session_destroy(); => Huy tat ca session lien quan den server
	//Huy session
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	
	//Chuyen den trang dang nhap
	header('location:?mod=login');
?>