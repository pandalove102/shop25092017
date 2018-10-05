<?php
	if(!isset($_SESSION['id']))header('location:?mod=login');
	
	$idUser=$_SESSION['id'];
	$idOrder=$_GET['id'];
	
	//Truy van de kiem tra truy cap
	$sql="select 1 from `nn_order` where `id`=$idOrder AND `user_id`=$idUser";
	$rs=mysqli_query($link,$sql);
		
	if(mysqli_num_rows($rs)==0)
		echo 'Truy cập không hợp lệ !';
	else
	{
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
	
	
	
	$sql="SELECT b.`id` , b.`name` , b.`img_url` , a.`qty` , a.`price` 
		FROM  `nn_order_detail` a,  `nn_product` b
		WHERE a.`product_id` = b.`id` 
		AND  `order_id` =$idOrder";
	$rs=mysqli_query($link,$sql);
	
	$s=0;
	$i=0;
	while($r=mysqli_fetch_assoc($rs))
	{
		$id=$r['id'];
		$v=$r['qty'];
	
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
	$sql='select `name`,`mobile`,`address`,`email`,`remark` from `nn_order` where `id`='.$idOrder;
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
?>
            <p class="error"><?php echo $msg ?></p>  
  <ul class="forms">
            <li class="txt">Name <span class="req">*</span></li>
              <li class="inputfield">
                <input name="name" type="text" disabled="disabled" required="required" class="bar" id="name" value="<?php echo $r['name'] ?>">
              </li>
</ul>
  <ul class="forms">
    <li class="txt">Mobile <span class="req">*</span></li>
    <li class="inputfield">
      <input name="mobile" type="text" disabled="disabled" required="required" class="bar" id="mobile" value="<?php echo $r['mobile'] ?>" />
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">Email <span class="req">*</span></li>
    <li class="inputfield">
      <input name="email" type="text" disabled="disabled" required="required" class="bar" id="email" value="<?php echo $r['email'] ?>" />
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">Address <span class="req">*</span></li>
    <li class="textfield">
      <textarea name="address" disabled="disabled" required="required" class="bar" id="address"><?php echo $r['address'] ?></textarea>
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">Note <span class="req">*</span></li>
    <li class="textfield">
      <textarea name="remark" disabled="disabled" required="required" class="bar" id="remark"><?php echo $r['remark']?></textarea>
    </li>
  </ul>
  <ul class="forms">
    <li class="txt">&nbsp;</li>
                <li>
                <button id="sm" style="width:0;height:0;border:none" type="submit"></button></li>
  </ul>
        <div class="clear"></div>
         <a href="javascript:history.go(-1)" class="simplebtn"><span>Back</span></a>
<?php
	}
?>