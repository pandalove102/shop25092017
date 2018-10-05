<?php
	$user=$_POST['user'];
	$pass=sha1($_POST['pass']);
	
	//Truy van DB de kiem tra
	$sql="SELECT `id`,`name` FROM `nn_user` WHERE `email` = '$user' AND `password` = '$pass'";
	$rs=mysqli_query($link,$sql);
	if(mysqli_num_rows($rs)==0)
	{
?>
		<script>
			window.onload=function(){
				alert("Đăng nhập không thành công. Sai email hoặc mật khẩu");
				setTimeout('window.location="?mod=login"',0);
			}
		</script>
<?php
	}
	else//email, pass đúng
	{
		//Lay thong tin
		$r=mysqli_fetch_assoc($rs);
		$r['id'];		
		//Luu id cua user vao session
		$_SESSION['id']=$r['id'];
		$_SESSION['name']=$r['name'];
		//Chuyen den trang chu
		header('location:?mod=home');
	}
?>
