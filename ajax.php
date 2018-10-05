<?php
	require('lib/db.php');
	
	//date_default_timezone_set('Asia/Ho_Chi_Minh');
	//echo date('d/m/Y H:i:s');
	//echo '<h1> Test </h1>';
	$email=$_POST['email'];
	
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		echo '<img src="images/deny.png" alt="deny"> Email không hợp lệ';
	else
	{
		//Kiem tra email co hay khong
		$sql="select 1 from `nn_user` where `email`='$email'";
		$rs=mysqli_query($link,$sql);
		
		if(mysqli_num_rows($rs)==0)
			echo '<img src="images/accept.png" alt="accept"> Bạn có thể sử dụng email này để đăng ký';
		else
			echo '<img src="images/deny.png" alt="deny"> Email này đã tồn tại. Hãy dùng email khác';
	}
?>
