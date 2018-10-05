<?php
	if(!isset($_SESSION['id']))header('location:?mod=login');
	
	$idUser=$_SESSION['id'];
	$cart=$_SESSION['cart'];
	
	if(count($cart)==0)
		echo 'Bạn chưa chọn mua sản phẩm nào. Hãy click <a href="?mod=list">vào đây</a> để chọn mua sản phẩm';
	else
	{
	
	if(isset($_POST['name']))
	{
		//print_r($_POST);
		
		$name=$_POST['name'];
		$mobile=$_POST['mobile'];
		$email=$_POST['email'];
		$address=$_POST['address'];
		$remark=$_POST['remark'];
		
		//Insert vao bang order
		$sql="insert into `nn_order` values(NULL,'$idUser',now(),'$name','$address','','$email','$mobile','$remark','0')";
		mysqli_query($link,$sql);
			
		//Insert vao bang order_detail
		$order_id=mysqli_insert_id($link);//Lay id (A_I) cua lenh insert ngay truoc
		
	
		foreach($cart as $k=>$v)
		{
			//Lay price tai thoi diem dat hang
			$sql='select `price` from `nn_product` where `id`='.$k;
			$rs=mysqli_query($link,$sql);
			$r=mysqli_fetch_assoc($rs);
			$price=$r['price'];
			
			//Insert vao bang order_detail
			$sql="insert into `nn_order_detail` values('$order_id','$k','$v','$price')";
			mysqli_query($link,$sql);
			
		}
?>
		<script>
		window.onload=function()
		{
			alert('Bạn đã đặt hàng thành công');
			window.location='?mod=account';
		}
		</script>
<?php		
		
	}
	
?>
<h2 class="heading colr">Checkout</h2>
<div class="shoppingcart">
<ul class="tablehead">
    <li class="remove colr">No</li>
    <li class="thumb colr">&nbsp;</li>
    <li class="title colr">Product Name</li>
    <li class="price colr">Unit Price</li>
    <li class="qty colr">QTY</li>
    <li class="total colr">Sub Total</li>
</ul>
<?php
	
	if(count($_SESSION['cart']))
		$cart=$_SESSION['cart'];
	else
		$cart=array(0);//array(0=>0);
		
	print_r($cart);
	
	$keys=array_keys($cart);//Lay key cua mang
	$ids=implode(',',$keys);//Chuyen mang thanh chuoi
	
	$sql="select `id`,`img_url`,`name`,`price` from `nn_product` where `id` in ($ids)";
	$rs=mysqli_query($link,$sql);
	
	$s=0;
	$i=0;
	while($r=mysqli_fetch_assoc($rs))
	{
		$id=$r['id'];
		$v=$cart[$id];
	
		$s=$s + $r['price']*$v;
?>
        <ul class="cartlist <?php $i++;if($i%2==1)echo 'gray' ?>">
            <li class="remove txt"><?php echo $i ?></li>
            <li class="thumb"><a href="?mod=detail&id=<?php echo $r['id'] ?>"><img src="images/sanpham/<?php echo $r['img_url'] ?>" alt="" ></a></li>
            <li class="title txt"><a href="detail.html"><?php echo $r['name'] ?></a></li>
            <li class="price txt"><?php echo number_format($r['price']) ?></li>
            <li class="qty txt" ><?php echo $v ?></li>
            <li class="total txt"><?php echo number_format($r['price']*$v) ?></li>
        </ul>
<?php
	}
?>
<div class="clear"></div>
<div class="subtotal">
    <h3 class="colr"><?php echo number_format($s) ?></h3>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<h2 class="heading colr">SHIPPING INFO</h2>
<?php
	//Lay thong tin cua nguoi dat hang (dang dang nhap)
	$sql='select `name`,`mobile`,`address`,`email` from `nn_user` where `id`='.$idUser;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
?>
<form action="" method="post" id="checkout">
            <p class="error"><?php echo $msg ?></p>  
  <ul class="forms">
            <li class="txt">Name <span class="req">*</span></li>
              <li class="inputfield">
                <input type="text" value="<?php echo $r['name'] ?>" name="name" class="bar" required="required" id="name">
              </li>
            </ul>
  <ul class="forms">
    <li class="txt">Mobile <span class="req">*</span></li>
    <li class="inputfield">
      <input type="text" value="<?php echo $r['mobile'] ?>" name="mobile" class="bar" required="required" id="mobile" />
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">Email <span class="req">*</span></li>
    <li class="inputfield">
      <input type="text" value="<?php echo $r['email'] ?>" name="email" class="bar" required="required" id="email" />
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">Address <span class="req">*</span></li>
    <li class="textfield">
      <textarea name="address" required="required" class="bar" id="address"><?php echo $r['address'] ?></textarea>
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">Note <span class="req">*</span></li>
    <li class="textfield">
      <textarea name="remark" required="required" class="bar" id="remark"></textarea>
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">&nbsp;</li>
                <li>
                <button id="sm" style="width:0;height:0;border:none" type="submit"></button></li>
  </ul>
</form>
        <div class="clear"></div>
         <a href="?mod=list" class="simplebtn"><span>Continue Shopping</span></a>
         <a href="?mod=cart" class="simplebtn"><span>Update</span></a>         
         <a href="javascript:$('#name,#email,#mobile,#address').val('')" class="simplebtn"><span>Clear all</span></a>        
         <a href="javascript:document.getElementById('checkout').reset()" class="simplebtn"><span>Reset</span></a>        
                
         <a href="#" onclick="document.getElementById('sm').click()" class="simplebtn"><span>Checkout</span></a>
<?php
	}
?>