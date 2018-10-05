<?php
	if(isset($_POST['email']))
	{
		$email=mysqli_real_escape_string($link,$_POST['email']);
		$sql="select * from `nn_user` where `email`='$email'";
		$rs=mysqli_query($link,$sql);
		
		if(mysqli_num_rows($rs)==0)
			$msg='Email không có trong hệ thống';
		else
		{
			$r=mysqli_fetch_assoc($rs);
			//Sinh mat khau ngau hien
			$bank = 'qwertyuiopasdfghjklzxcvbnm1234567890';
			$pass = '';
			for($i=0;$i<6;$i++)
				$pass.=$bank[mt_rand(0,strlen($bank)-1)];//Lay 1 ky tu ngau nhien
				
			//include thu vien send mail (phpmailer)
			include('lib/function.php');
			
			$from='info@faceshop.com';
			$to=$email;
			$subject='FaceShop - Reset password';
			$message='Chào bạn <b>'.$r['name'].'</b><br>
					  Mật khẩu của bạn đã được reset thành: <b>'.$pass.'</b><br>
					  Good luck !';
					  
			if(mailer($from,$to,$subject,$message))//Neu gui thanh cong
			{
				//Cap nhat lai pass trong DB
				$sql="update `nn_user` set `password`=sha1('$pass') where `id`=".$r['id'];
				mysqli_query($link,$sql);
				$msg='Reset mật khẩu thành công. Hãy kiểm tra email của bạn';
			}
		}
		
	}
?>                
<h2 class="heading colr">Reset password</h2>
<div class="login">
    <div class="registrd">
        <form action="" method="post" id="reset">
            <p class="error"><?php echo $msg?></p>
          <ul class="forms">
                <li class="txt">Email Address <span class="req">*</span></li>
                <li class="inputfield"><input type="text" name="email" class="bar" required ></li>
            </ul>
            <ul class="forms">
              <li class="txt">&nbsp;</li>
                <li><a href="#" onClick="document.getElementById('reset').submit()" class="simplebtn"><span>Reset</span></a></li>
            </ul>
        </form>
    </div>
</div>
<div class="clear"></div>