<?php
	if(isset($_POST['user']))
	{
		//print_r($_POST);
		$user=mysqli_real_escape_string($link,$_POST['user']);
		//$user=$_POST['user'];
		$pass=sha1($_POST['pass']);
		$sql="select * from `nn_admin` where `email`='$user'";
		$rs=mysqli_query($link,$sql);
		if(mysqli_num_rows($rs)==0)//Email
			$msg='Email không đúng ';
		else//dung email => kiem tra pass
		{
			$r=mysqli_fetch_assoc($rs);
			if($pass==$r['password'])//pass dung
			{				
				$_SESSION['admin_id']=$r['id'];
				$_SESSION['admin_name']=$r['name'];
				//chuyen trang
				header('location:?mod=home');
			}
			else
				$msg='Mật khẩu không đúng ';
		}
	}
?>
    <h2 class="heading colr">Login</h2>
    <div class="login">
        <div class="registrd">
            <form action="" method="post" id="login">
                <h3>Please Sign In</h3>
                <p class="error"><?php echo $msg ?></p>
                <ul class="forms">
                    <li class="txt">Email Address <span class="req">*</span></li>
                    <li class="inputfield"><input type="text" name="user" class="bar" required ></li>
                </ul>
                <ul class="forms">
                    <li class="txt">Password <span class="req">*</span></li>
                    <li class="inputfield"><input type="password" name="pass" class="bar" required ></li>
                </ul>
                <ul class="forms">
                    <li class="txt">&nbsp;</li>
                    <li><a href="#" onClick="document.getElementById('sm').click()" class="simplebtn"><span>Login</span></a><button id="sm" style="width:0;height:0;border:none" type="submit"></button> <a href="#" class="forgot">Forgot Your Password?</a></li>
                </ul>
            </form>
        </div>
        
    </div>
    <div class="clear"></div>
    