<?php
	if(!isset($_SESSION['id']))header('location:?mod=login');
	
	//Da dang nhap roi
	$id=$_SESSION['id'];
	

	$msg='';
	if(isset($_POST['name']))//Neu nhu co submit
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$repass=$_POST['repass'];
		$mobile=$_POST['mobile'];
		$dob=$_POST['dob'];
		//Chuyen dinh dang tu dd/mm/yyyy -> yyyy-mm-dd
		$d=substr($dob,0,2);
		$m=substr($dob,3,2);
		$y=substr($dob,6,4);
		
		$dob="$y-$m-$d";
		
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		
		//Kiem tra du lieu
		if($pass!='' && strlen($pass)<6)
			$msg='Mật khẩu tối thiểu 6 ký tự';
		elseif($pass!=$repass)
			$msg='Mật khẩu nhập lại không đúng';
		else//Tat ca du lieu hop le
		{	
		
			//Tao cau sql update
			if($pass!='')
				$sql="update `nn_user` set
					`name`='$name',
					`password`=sha1('$pass'),
					`mobile`='$mobile',
					`dob`='$dob',
					`gender`='$gender',
					`address`='$address'
					where `id`=$id";
			else
				$sql="update `nn_user` set
					`name`='$name',
					`mobile`='$mobile',
					`dob`='$dob',
					`gender`='$gender',
					`address`='$address'
					where `id`=$id";
					
			echo $sql;
			$rs=mysqli_query($link,$sql);
			if($rs)
			{
				$msg='Cập nhật thành công.';
			}
			else
			{
				$msg='Cập nhật không thành công.';
			}
		}
		
	}
	
	//Truy van lay cac thong tin can thiet
	$sql='select * from `nn_user` where `id`='.$id;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
?>
<h2 class="heading colr">Update</h2>
<div class="login">
    <div class="registrd">
        <form action="" method="post">
            <p class="error"><?php echo $msg ?></p>  
          <ul class="forms">
            <li class="txt">Name <span class="req">*</span></li>
              <li class="inputfield">
                <input type="text" value="<?php echo $r['name'] ?>" name="name" class="bar" required="required" id="name">
              </li>
            </ul>
          <ul class="forms">
            <li class="txt">Password <span class="req">*</span></li>
              <li class="inputfield">
                <input type="password" name="pass" placeholder="Tối thiểu 6 ký tự" class="bar" id="pass"><br><em>(Để trống nếu không muốn thay đổi mật khẩu)</em>
            </li>
            </ul>
          <ul class="forms">
              <li class="txt">Retype password<span class="req">*</span></li>
              <li class="inputfield">
                <input type="password" name="repass" class="bar" id="repass">
              </li>
            </ul>
          <ul class="forms">
            <li class="txt">Mobile <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" value="<?php echo $r['mobile'] ?>" name="mobile" class="bar" required="required" id="mobile">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">DOB <span class="req">*</span></li>
            <li class="inputfield">
              <input type="text" readonly value="<?php echo date('d/m/Y',strtotime($r['dob'])) ?>" name="dob" class="bar" required="required" id="dob">
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Gender <span class="req">*</span></li>
            <li class="inputfield">
              <select name="gender" id="gender">
              	<option <?php if($r['gender']==1) echo 'selected' ?> value="1">Nam</option>
                <option <?php if($r['gender']==0) echo 'selected' ?> value="0">Nữ</option>
              </select>
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">Address <span class="req">*</span></li>
            <li class="textfield">
              <textarea name="address" required="required" class="bar" id="address"><?php echo $r['address'] ?></textarea>
            </li>
          </ul>
          <ul class="forms">
            <li class="txt">&nbsp;</li>
                <li><a href="#" onclick="document.getElementById('sm').click()" class="simplebtn"><span>Update</span></a><button id="sm" style="width:0;height:0;border:none" type="submit"></button></li>
          </ul>
        </form>
    </div>                    
</div>
<div class="clear"></div>
<script type="text/javascript" src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<link href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" />
<script>
	$('#dob').datepicker({
		dateFormat:'dd/mm/yy',
		changeMonth:true,
		changeYear:true,
		yearRange:'-99:+0',
	})
</script>

