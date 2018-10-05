<?php
	//Tao cookie
	
	$THEME=array(1=>'_blue','_green','_orange','');	
	$th=$_GET['color'];
	
	//Luu theme 1 tuan
	setcookie('theme',$THEME[$th],time()+7*24*3600);
	
	//print_r($_SERVER);
	
	header('location:'.$_SERVER['HTTP_REFERER']);
?>