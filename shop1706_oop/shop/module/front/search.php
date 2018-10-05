
<?php
	//print_r($_POST);
	$kw=mysqli_real_escape_string($link,$_REQUEST['kw']);
	//$kw=htmlentities($kw);
	$kw=str_replace('<script>','',$kw);//Xoa <script> trong $kw
	$kw=str_replace('</script>','',$kw);
	
	if($kw=='')$kw='@';
	
	$cid=$_REQUEST['cid'];
	$price=$_REQUEST['price'];
?>            
<h4 class="heading colr">Search</h4>
<div class="inputfield">
<form action="?mod=search" method="post">
    <ul class="forms">
        <li class="inputfield">
            <input type="search" value="<?php echo $kw ?>" placeholder="Nhập từ khóa" name="kw" >
            <select name="cid">
                <option value="0">--- Chọn loại ---</option>
                <?php
                    $sql='select `id`,`name` from `nn_department` where `active`=1 order by `order`';
                    $rsDep=mysqli_query($link,$sql);
                    while($r=mysqli_fetch_assoc($rsDep))
                    {
                ?>
                        <optgroup label="<?php echo $r['name']?>">
                        <?php
                            $sql='select `id`,`name` from `nn_category` where `active`=1 AND `department_id`='.$r['id'];
                            $rsCat=mysqli_query($link,$sql);
                            while($r=mysqli_fetch_assoc($rsCat))
                            {
                        ?>
                                <option <?php if($r['id']==$cid) echo 'selected' ?> value="<?php echo $r['id']?>"><?php echo $r['name']?></option>
                        <?php
                            }
                        ?>
                        </optgroup>
               <?php
                    }
               ?>
            </select>
             <select name="price">
                <option <?php if(0==$price) echo 'selected' ?> value="0">--- Chọn giá ---</option>
                <option <?php if(1==$price) echo 'selected' ?> value="1">Dưới 5 triệu</option>
                <option <?php if(2==$price) echo 'selected' ?> value="2">Từ 5 đến 10 triệu</option>
                <option <?php if(3==$price) echo 'selected' ?> value="3">Từ 10 đến 15 triệu</option>
                <option <?php if(4==$price) echo 'selected' ?> value="4">Từ 15 đến 20 triệu</option>
                <option <?php if(5==$price) echo 'selected' ?> value="5">Từ 20 đến 30 triệu</option>
                <option <?php if(6==$price) echo 'selected' ?> value="6">Trên 30 triệu</option>
            </select>
            <button type="submit"> Tìm </button>
        </li>
    </ul>                
</form>    
</div>
<?php 
   

	//tim theo tu khoa
	$cond="`name` like '%$kw%'";
	
	if($cid>0)//Co tim theo loai
	$cond=$cond." AND `category_id`=$cid";
	
	if($price==1)
	$cond=$cond." AND `price` < 5000000";
	
	if($price==2)
	$cond=$cond." AND `price` between 5000000 and 10000000";
	
	if($price==3)
	$cond=$cond." AND `price` between 10000000 and 15000000";
	
	if($price==4)
	$cond=$cond." AND `price` between 15000000 and 20000000";
	
	if($price==5)
	$cond=$cond." AND `price` between 20000000 and 30000000";
	
	if($price==6)
	$cond=$cond." AND `price` > 30000000";
	
    //$cid=$_GET['cid'];//Loai hien tai
    //if($cid=='')$cid=1;
    
    $page=$_GET['page'];//Trang hien tai
    if($page<1)$page=1;
    
    $sort=$_GET['sort'];
    if($sort=='')$sort=1;
    
    //Tinh so trang
    $sql="select count(*) from `nn_product` where $cond";
    $rs=mysqli_query($link,$sql);
    $r=mysqli_fetch_row($rs);
    $nop=ceil($r[0]/20);
	
	if($nop==0)
		 	echo 'Không tìm thấy sản phẩm nào với từ khóa '.$kw;
		
	else
	{
	
	
    if($page>$nop)$page=$nop;
    
?>
<div class="sorting">
    <p class="left colr"><?php echo $r[0] ?> Item(s)</p>
    <ul class="right">
      <li class="text">Page
          <a href="?mod=search&kw=<?php echo $kw ?>&page=1&sort=<?php echo $sort ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr" title="Trang đầu">&lt;&lt;</a> 
          <a href="?mod=search&kw=<?php echo $kw ?>&page=<?php echo $page-9 ?>&sort=<?php echo $sort ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr" title="Nhóm trang trước">&lt;</a>                        
        <?php
            for($i=$page-4;$i<=$page+4;$i++)
            if($i>=1 && $i<=$nop)
            {
        ?>
              <a href="?mod=search&kw=<?php echo $kw ?>&page=<?php echo $i ?>&sort=<?php echo $sort ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr <?php if($i==$page)echo 'current' ?>"><?php echo $i ?></a> 
        <?php
            }
        ?>
          <a href="?mod=search&kw=<?php echo $kw ?>&page=<?php echo $page+9 ?>&sort=<?php echo $sort ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr" title="Nhóm trang sau">&gt;</a> 
          <a href="?mod=search&kw=<?php echo $kw ?>&page=<?php echo $nop ?>&sort=<?php echo $sort ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr" title="Trang cuối">&gt;&gt;</a> 
        </li>
    </ul>
    <div class="clear"></div>
    <p class="left">View as: <a href="#" class="bold">Grid</a>&nbsp;<a href="#" class="colr">List</a></p>
    <ul class="right">
        <li class="text">
            Sort by Position
            <a <?php if($sort<3)echo 'class="current"' ?> href="?mod=search&kw=<?php echo $kw ?>&sort=<?php if($sort==1) echo 2;else echo 1 ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr">Price 
            <?php 
                    if($sort==1) echo '<img src="images/asc.png" alt="asc">'; 
                    if($sort==2) echo '<img src="images/desc.png" alt="desc">'; 
            ?>
            </a> | 
            <a <?php if($sort>=3)echo 'class="current"' ?> href="?mod=search&kw=<?php echo $kw ?>&sort=<?php if($sort==3) echo 4;else echo 3 ?>&cid=<?php echo $cid ?>&price=<?php echo $price?>" class="colr">View 
            <?php 
                    if($sort==3) echo '<img src="images/asc.png" alt="asc">'; 
                    if($sort==4) echo '<img src="images/desc.png" alt="desc">'; 
            ?>
            </a> 
        </li>
    </ul>
</div>
<div class="clear"></div>
<div class="listing">
    <h4 class="heading colr">New Products for March 2010</h4>
    <ul>
    <?php
        
		
        $pos=($page-1)*20;
        
        
        
        $order='`price`';
        if($sort==2)$order='`price` desc';
        if($sort==3)$order='`view`';
        if($sort==4)$order='`view` desc';
        
        
        
        //Lay cac san pham thuoc 1 loai
        echo $sql="select `id`,`name`,`img_url`,`price` 
        from `nn_product` 
        where $cond 
        order by $order
        limit $pos,20";
        $rs=mysqli_query($link,$sql);
        $i=0;
        while($r=mysqli_fetch_assoc($rs))
        {
            $i++;
    ?>
            <li <?php  if($i%4==0) echo 'class="last"'; ?>>
                <a href="?mod=detail&id=<?php echo $r['id']  ?>" class="thumb"><img src="images/sanpham/<?php if(is_file('images/sanpham/'.$r['img_url']))echo $r['img_url'];else echo 'noImage.jpg'?>" alt="" ></a>
                <h6 class="colr"><?php echo $r['name']?></h6>
                <div class="stars">
                    <a href="#"><img src="images/star_green.gif" alt="" ></a>
                    <a href="#"><img src="images/star_green.gif" alt="" ></a>
                    <a href="#"><img src="images/star_green.gif" alt="" ></a>
                    <a href="#"><img src="images/star_green.gif" alt="" ></a>
                    <a href="#"><img src="images/star_grey.gif" alt="" ></a>
                    <a href="#">(3) Reviews</a>
                </div>
                <div class="addwish">
                    <a href="#">Add to Wishlist</a>
                    <a href="#">Add to Compare</a>
                </div>
                <div class="cart_price">
                    <a href="cart.html" class="adcart">Add to Cart</a>
                    <p class="price"><?php echo number_format($r['price']/1000000,2)?> Tr</p>
                </div>
            </li>
     <?php
        }
     ?>
    </ul>
</div>
<?php
}//end if
?>