<?php
$msg='';
if(isset($_POST['name']))//Neu nhu co submit
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$repass=$_POST['repass'];
	$mobile=$_POST['mobile'];
	$captcha=$_POST['captcha'];
	
	//Kiem tra captcha
	if($captcha!=$_SESSION['captcha'])
		$msg='Ảnh bảo mật nhập không đúng';
	//Kiem tra du lieu
	elseif(strlen($pass)<6)
		$msg='Mật khẩu tối thiểu 6 ký tự';
	elseif($pass!=$repass)
		$msg='Mật khẩu nhập lại không đúng';
	else//Tat ca du lieu hop le
	{	
	
		//Tao cau sql insert
		echo $sql="insert into `nn_user`(`name`,`password`,`email`,`mobile`) values('$name',sha1('$pass'),'$email','$mobile')";
		
		$rs=mysqli_query($link,$sql);
		if($rs)
		{
			$msg='Đăng ký thành công. Hệ thống sẽ chuyển đến trang đăng nhập...';
	?>
			<script>
				setTimeout('window.location="?mod=login"',3000);
			</script>
	<?php
		}
		else
		{
			$msg='Đăng ký không thành công. Email đã tồn tại';
		}
	}
	
}
?>
<h2 class="heading colr">Register</h2>
<div class="login">
    <div class="registrd">
        <form action="" method="post">
            <h3>Please Sign up</h3>
          <p align="center" class="error"><?php echo $msg ?></p>  
          <ul class="forms">
              <li class="txt">Name <span class="req">*</span></li>
              <li class="inputfield">
                <input type="text" value="<?php echo @$name ?>" name="name" class="bar" required="required" id="name" />
              </li>
            </ul>
          <ul class="forms">
              <li class="txt">Email  <span class="req">*</span></li>
              <li class="inputfield">
                <input onblur="callAjax()" type="text" name="email" class="bar" required="required" id="email" />
                <div id="msg"></div>
              </li>
            </ul>
          <ul class="forms">
              <li class="txt">Password <span class="req">*</span></li>
              <li class="inputfield">
                <input type="password" name="pass" placeholder="Tối thiểu 6 ký tự" class="bar" required="required" id="pass" />
              </li>
            </ul>
          <ul class="forms">
              <li class="txt">Retype password<span class="req">*</span></li>
              <li class="inputfield">
                <input type="password" name="repass" class="bar" required="required" id="repass" />
              </li>
            </ul>
          <ul class="forms">
            <li class="txt">Mobile <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="mobile" class="bar" required="required" id="mobile" />
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Captcha <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" name="captcha" class="bar" required="required" id="captcha" style="width:80px" />
            <img id="cimg" style="vertical-align:middle" src="lib/captcha.php" alt="captcha" /><img style="vertical-align:middle;cursor:pointer" onclick="document.getElementById('cimg').src='lib/captcha.php?rand='+Math.random()" src="images/refresh.png" alt="refresh" /></li>
          </ul>
          <ul class="forms">
            <li class="txt">&nbsp;</li>
                <li><a href="#" onClick="document.getElementById('sm').click()" class="simplebtn"><span>Register</span></a><button id="sm" style="width:0;height:0;border:none" type="submit"></button></li>
            </ul>
        </form>
    </div>                    
</div>
<div class="clear"></div>
<script>
function callAjax()
{
	
	$.ajax({
		url:'ajax.php',
		method:'POST',
		data:{email:$('#email').val()},
		success:function(data){
			$('#msg').html(data);
		}
	});
}
</script>