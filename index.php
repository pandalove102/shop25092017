<?php
	ob_start();//cached output, tranh loi khi su dung header(...)
	session_start();
	require('lib/db.php');
	//error_reporting(E_ALL);develop mode
	//error_reporting(0);//product mode
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Estore 16</title>
<!-- // Stylesheets // -->
<link rel="stylesheet" href="css/style<?php echo $_COOKIE['theme'] ?>.css" type="text/css" >
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" >
<link rel="stylesheet" href="css/default.advanced.css" type="text/css" >
<link rel="stylesheet" href="css/contentslider.css" type="text/css"  >
<link rel="stylesheet" href="css/jquery.fancybox-1.3.1.css" type="text/css" media="screen" >
<!-- // Javascript // -->
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script>
<script type="text/javascript" src="js/scroll.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/acordn.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/Trebuchet_MS_400-Trebuchet_MS_700-Trebuchet_MS_italic_700-Trebuchet_MS_italic_400.font.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/contentslider.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
</head>

<body>
<a name="top"></a>
<div id="wrapper_sec">
	<!-- Header -->
	<div id="masthead">
    	<div class="secnd_navi">
        	<ul class="links">
            	<li>
				<?php
					//$sql='select `name` from `nn_user` where `id`='.$_SESSION['id'];
					//$rs=mysqli_query($link,$sql);
					//$r=mysqli_fetch_assoc($rs);
					//echo 'Xin chào ',$r['name'];
					if(isset($_SESSION['name']))//Neu da dang nhap
					echo 'Xin chào ',$_SESSION['name'];
                ?>
                </li>
                <li>
                	<?php
					if(isset($_SESSION['id']))
						echo ' <a href="?mod=account">Tài khoản</a>';
				?>    
                </li>
                <li><a href="#">My Wishlist</a></li>
                <li><a href="?mod=cart">Giỏ hàng</a></li>
                <li><a href="#">Checkout</a></li>
                <li class="last">
                <?php
					if(isset($_SESSION['id']))
						echo ' <a href="?mod=logout">Đăng xuất</a>';
					else
						echo '<a href="?mod=login">Đăng nhập</a>';
				?>             	
                   
                </li>
            </ul>
            <ul class="network">
            	<li>Share with us:</li>
                <li><a href="#"><img src="images/linkdin.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/rss.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/twitter.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/facebook.gif" alt="" ></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    	<div class="logo">
        	<a href="index.html"><img src="images/logo.png" alt="" ></a>
            <h5 class="slogn">The best watches for all</h5>
        </div>
        <ul class="search">
        	<li>
            <form action="?mod=search" method="post">
            	<input type="search" value="" id="searchBox" name="kw" placeholder="Nhập từ khóa" class="bar" >
            </form>
            </li>
            
            <li><a href="#" class="searchbtn">Search for Products</a></li>
        </ul>
        <div class="clear"></div>
        <div class="navigation">
            <ul id="nav" class="dropdown dropdown-linear dropdown-columnar">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="static.html">Giới thiệu</a></li>
                <li class="dir"><a href="#">Sản phẩm</a>
                    <ul class="bordergr big">
                    <?php
						//Lay cac chung loai
						$sql='select `id`,`name` from `nn_department` where `active`=1 order by `order`';
						$rs=mysqli_query($link,$sql);
						while($r=mysqli_fetch_assoc($rs))
						{
					?>
                        <li class="dir"><span class="colr navihead bold"><?php echo $r['name']?></span>
                            <ul>
                            <?php
								//Lay cac loai sp thuoc chung loai tuong ung
								$idDep=$r['id'];
								
								$sqlCate="select `id`,`name` from `nn_category` 
									where `active`=1 AND `department_id`= $idDep
									order by `order`";
								$rsCate=mysqli_query($link,$sqlCate);
								while($rCate=mysqli_fetch_assoc($rsCate))
								{
							?>
                                <li><a href="san-pham-c<?php echo $rCate['id']?>.html"><?php echo $rCate['name']?></a></li>
                            <?php
								}
							?>
                            </ul>
                        </li>
                    <?php
						}
					?>
 <!--                       <li class="dir"><span class="colr navihead bold">Calvin Klein</span>
                            <ul>
                                <li><a href="categories.html">AK Anne Klein</a></li>
                                <li><a href="categories.html">Alexander Christie</a></li>
                                <li><a href="categories.html">Arbutus</a></li>
                                <li><a href="categories.html">Armitron</a></li>
                                <li><a href="categories.html">Body Glove</a></li>
                                <li><a href="categories.html">Calvin Klein</a></li>
                            </ul>
                        </li>
                        <li class="dir"><span class="colr navihead bold">Citizen</span>
                            <ul>
                                <li><a href="categories.html">AK Anne Klein</a></li>
                                <li><a href="categories.html">Alexander Christie</a></li>
                                <li><a href="categories.html">Arbutus</a></li>
                                <li><a href="categories.html">Armitron</a></li>
                                <li><a href="categories.html">Body Glove</a></li>
                                <li><a href="categories.html">Calvin Klein</a></li>
                            </ul>
                        </li>
                        <li class="dir"><span class="colr navihead bold">Calvin Klein</span>
                            <ul>
                                <li><a href="categories.html">AK Anne Klein</a></li>
                                <li><a href="categories.html">Alexander Christie</a></li>
                                <li><a href="categories.html">Arbutus</a></li>
                                <li><a href="categories.html">Armitron</a></li>
                                <li><a href="categories.html">Body Glove</a></li>
                                <li><a href="categories.html">Calvin Klein</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </li>
                <li><a href="login.html">BedSheets</a></li>
                <li class="dir"><a href="#">Pages</a>
                    <ul class="bordergr small">
                        <li class="dir"><span class="colr navihead bold">Pages</span>
                            <ul>
                                <li class="clear"><a href="index.html">Home Page</a></li>
                                <li class="clear"><a href="account.html">Account Page</a></li>
                                <li class="clear"><a href="cart.html">Shopping Cart Page</a></li>
                                <li class="clear"><a href="categories.html">Categories</a></li>
                                <li class="clear"><a href="?mod=detail&id=<?php echo $r['id']  ?>">Product Detail Page</a></li>
                                <li class="clear"><a href="listing.html">Listing Page</a></li>
                                <li class="clear"><a href="login.html">Login Page</a></li>
                                <li class="clear"><a href="static.html">Static Page</a></li>
                                <li class="clear"><a href="contact.html">Contact Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
                <li class="dir"><a href="#">Themes</a>
                    <ul class="bordergr small">
                        <li class="dir"><span class="colr navihead bold">Themes</span>
                            <ul>
                                <li class="clear"><a href="?mod=theme&color=1">Blue</a></li>
                                <li class="clear"><a href="?mod=theme&color=2">Green</a></li>
                                <li class="clear"><a href="?mod=theme&color=3">Orange</a></li>
                                <li class="clear"><a href="?mod=theme&color=4">Purple</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="lang">
            	<li>Your Language:</li>
                <li><a href="#"><img src="images/flag1.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/flag2.gif" alt="" ></a></li>
                <li><a href="#"><img src="images/flag3.gif" alt="" ></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!-- Banner Section -->
	<!--<div id="banner">
    	<div id="slider4" class="nivoSlider">
			<a href="?mod=detail&id=<?php echo $r['id']  ?>"><img src="images/banner1.jpg" alt="" ></a>
			<a href="?mod=detail&id=<?php echo $r['id']  ?>"><img src="images/banner2.jpg" alt="" ></a>
            <a href="?mod=detail&id=<?php echo $r['id']  ?>"><img src="images/banner3.jpg" alt="" ></a>
            <a href="?mod=detail&id=<?php echo $r['id']  ?>"><img src="images/banner4.jpg" alt="" ></a>
		</div>
        <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
		<script type="text/javascript" src="js/nivo.js"></script>
    </div>-->
    <div class="clear"></div>
    <!-- Scroolling Products -->
    <div class="content_sec">
    	<!-- Column2 Section -->
        <div class="col2">
        	<div class="col2_top">&nbsp;</div>
            <div class="col2_center">
            <?php 
				//include('module/home.php');
				//include('module/list.php');
				$mod=$_GET['mod'];
				if($mod=='')$mod='home';
				$mod=str_replace('../','',$mod);
				if(is_file("module/front/{$mod}.php"))
					include("module/front/{$mod}.php");
				else
					echo 'Invalid URL';
			?>
            </div>
            <div class="clear"></div>
            <div class="col2_botm">&nbsp;</div>
        </div>
        <!-- Column1 Section -->
    	<div class="col1">
        	<!-- Categories -->
                <div class="category">
                	<div class="col1center">
                    <div class="small_heading">
                        <h5>Categories</h5>
                    </div>
                    <div class="glossymenu">
                        
                         <?php
							//Lay cac chung loai
							$sql='select `id`,`name` from `nn_department` where `active`=1 order by `order`';
							$rs=mysqli_query($link,$sql);
							while($r=mysqli_fetch_assoc($rs))
							{
						?>
                                <a class="menuitem submenuheader" href="#" ><?php echo $r['name']?></a>
                                <div class="submenu">
                                    <ul>
                                     <?php
										//Lay cac loai sp thuoc chung loai tuong ung
										$idDep=$r['id'];
										
										$sqlCate="select `id`,`name` from `nn_category` 
											where `active`=1 AND `department_id`= $idDep
											order by `order`";
										$rsCate=mysqli_query($link,$sqlCate);
										while($rCate=mysqli_fetch_assoc($rsCate))
										{
									?>
                                        <li><a href="?mod=list&cid=<?php echo $rCate['id']?>"><?php echo $rCate['name']?></a></li>
                                    <?php
										}
									?> 
                                    </ul>
                                </div>
                        <?php
							}
						?>
                        <!--<a class="menuitem submenuheader" href="#" >Le Vele Bedding</a>
                        <div class="submenu">
                            <ul>
                                <li><a href="listing.html">Le Vele Bedding</a></li>
                                <li><a href="listing.html">LHF Bedding</a></li>
                                <li><a href="listing.html">Pacific Coast</a></li>
                                <li><a href="listing.html">SnugFleece Woolens</a></li>
                                <li><a href="listing.html">Southern Textiles</a></li>
                            </ul>
                        </div>
                        <a class="menuitem submenuheader" href="#" >LHF Bedding</a>
                        <div class="submenu">
                            <ul>
                                <li><a href="listing.html">Le Vele Bedding</a></li>
                                <li><a href="listing.html">LHF Bedding</a></li>
                                <li><a href="listing.html">Pacific Coast</a></li>
                                <li><a href="listing.html">SnugFleece Woolens</a></li>
                                <li><a href="listing.html">Southern Textiles</a></li>
                            </ul>
                        </div>
                        <a class="menuitem submenuheader" href="#" >Pacific Coast</a>
                        <div class="submenu">
                            <ul>
                                <li><a href="listing.html">Le Vele Bedding</a></li>
                                <li><a href="listing.html">LHF Bedding</a></li>
                                <li><a href="listing.html">Pacific Coast</a></li>
                                <li><a href="listing.html">SnugFleece Woolens</a></li>
                                <li><a href="listing.html">Southern Textiles</a></li>
                            </ul>
                        </div>
                        <a class="menuitem submenuheader" href="#" >SnugFleece Woolens</a>
                        <div class="submenu">
                            <ul>
                                <li><a href="listing.html">Le Vele Bedding</a></li>
                                <li><a href="listing.html">LHF Bedding</a></li>
                                <li><a href="listing.html">Pacific Coast</a></li>
                                <li><a href="listing.html">SnugFleece Woolens</a></li>
                                <li><a href="listing.html">Southern Textiles</a></li>
                            </ul>
                        </div>
                        <a class="menuitem submenuheader" href="#" >Southern Textiles</a>
                        <div class="submenu">
                            <ul>
                                <li><a href="listing.html">Le Vele Bedding</a></li>
                                <li><a href="listing.html">LHF Bedding</a></li>
                                <li><a href="listing.html">Pacific Coast</a></li>
                                <li><a href="listing.html">SnugFleece Woolens</a></li>
                                <li><a href="listing.html">Southern Textiles</a></li>
                            </ul>
                        </div>-->	
                    </div>
                    </div>
                    <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
                </div>
                <!-- My Cart Products -->
                <div class="mycart">
                	<div class="col1center">
                    <div class="small_heading">
                        <h5>My Cart</h5>
                        <div class="clear"></div>
                        <span class="veiwitems">(<?php echo count($_SESSION['cart'])?>) Items - <a href="?mod=cart" class="colr">View Cart</a></span>
                    </div>
                    <ul>
                    <?php
						$cart=$_SESSION['cart'];
						
						if(count($_SESSION['cart']))
							$cart=$_SESSION['cart'];
						else
							$cart=array(0);//array(0=>0);						
			
						
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
                            <li>
                                <p class="bold title">
                                    <a href="?mod=detail&id=<?php echo $r['id']  ?>"><?php echo $r['name'] ?></a>
                                </p>
                                <div class="grey">
                                    <p class="left">QTY: <span class="bold"><?php echo $v ?></span></p>
                                    <p class="right">Price: <span class="bold"><?php echo number_format($r['price']) ?></span></p>
                                </div>
                            </li>
                        <?php
						}
						?>
            <!--            <li>
                            <p class="bold title">
                                <a href="?mod=detail&id=<?php echo $r['id']  ?>">Armani Tweed Blazer</a>
                            </p>
                            <div class="grey">
                                <p class="left">QTY: <span class="bold">3</span></p>
                                <p class="right">Price: <span class="bold">$200</span></p>
                            </div>
                        </li>
                        <li>
                            <p class="bold title">
                                <a href="?mod=detail&id=<?php echo $r['id']  ?>">Armani Tweed Blazer</a>
                            </p>
                            <div class="grey">
                                <p class="left">QTY: <span class="bold">3</span></p>
                                <p class="right">Price: <span class="bold">$200</span></p>
                            </div>
                        </li>-->
                    </ul>
                    <p class="right bold sub">Sub total: <?php echo number_format($s) ?></p>
                    <div class="clear"></div>
                    <a href="?mod=checkout" class="simplebtn right"><span>Checkout</span></a>
                    </div>
                    <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
                </div>
                <div class="poll">
                <div class="col1center">
            	<div class="small_heading">
            		<h5>Poll</h5>
                </div>
                <?php
					//Lay cau hoi active
					$sql='select `id`,`content` from `nn_question` where `active`=1';
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_assoc($rs);
				?>
                <p><?php echo $r['content']?></p>
                <form action="?mod=poll" method="post" id="poll">
                <ul>
                	<?php
						//Lay cac lua chon cua hoi tren
						$sql='select `id`,`content` from `nn_answer` where `question_id`='.$r['id'];
						$rs=mysqli_query($link,$sql);
						while($r=mysqli_fetch_assoc($rs))
						{
					?>
                            <li><label><input name="answer" type="radio" value="<?php echo $r['id']?>" ><?php echo $r['content']?></label></li>                     
                   <?php
						}
				   ?>
                </ul>   
                </form>            
                <a href="javascript:document.getElementById('poll').submit()" class="simplebtn"><span>Vote</span></a>
                </div>
                <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
            </div>
            <div class="clear"></div>
            <div class="poll">
                <div class="col1center">
            	<div class="small_heading">
            		<h5>STATS</h5>
                </div>
                
                <?php
					//Cap nhat so luot truy cap
					if(!isset($_SESSION['visit']))
					{
						$sql='update `nn_visit` set `cnt`=`cnt`+1';
						mysqli_query($link,$sql);
						$_SESSION['visit']=1;
					}
					
					//Lay so luot truy cap
					$sql='select `cnt` from `nn_visit`';
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_assoc($rs);
					$visit=$r['cnt'];
					
					//Xu ly user online
					
					$id=session_id();
					$now=time();
					$user=$_SESSION['id'];
					
					//insert vao DB neu $id không trung, nguoc lai la update
					$sql="replace into `nn_online` values('$id','$now','$user')";
					mysqli_query($link,$sql);
					
					//Xoa nguoi dung timeout
					$timeout=1;//Phút
					$sql="delete from `nn_online` where $now-`last_access` > $timeout * 60";
					mysqli_query($link,$sql);
					
					//Dem so nguoi dang online
					$sql='select count(`id`) from `nn_online`';
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_row($rs);
					$online=$r[0];
					
					//Dem so thanh vien
					$sql='select count(`id`) from `nn_online` where `user`!=""';
					$rs=mysqli_query($link,$sql);
					$r=mysqli_fetch_row($rs);
					$member=$r[0];
					
				?>
                
                Số người online: <?php echo str_pad($online,6,'0',STR_PAD_LEFT)?><br>
                Số thành viên: <?php echo str_pad($member,6,'0',STR_PAD_LEFT)?><br>
                Số khách: 1344343<br>
                Số lượt truy cập: <?php echo str_pad($visit,6,'0',STR_PAD_LEFT)?>
               
                </div>
                <div class="clear"></div>
                    <div class="left_botm">&nbsp;</div>
            </div>
            
        </div>
    </div>
    <div class="clear"></div>
</div>
<!-- Footer Section -->
	<div id="footer">
    	<div class="foot_inr">
        <div class="foot_top">
        	<div class="foot_logo">
            	<a href="#"><img src="images/footer_logo.png" alt="" ></a>
            </div>
            <div class="botm_navi">
            	<ul>
                	<li><a href="#">Home page</a></li>
                    <li><a href="#">Who we are</a></li>
                    <li><a href="#">Formoda news &amp; blog</a></li>
                    <li><a href="#">Follow us on Twitter</a></li>
                    <li><a href="#">Befriend us on Facebook</a></li>
                </ul>
                <ul>
                	<li><a href="#">Shipping &amp; Returns</a></li>
                    <li><a href="#">Secure Shopping</a></li>
                    <li><a href="#">International Shipping</a></li>
                    <li><a href="#">Affiliates</a></li>
                    <li><a href="#">Group Sales</a></li>
                </ul>
                <ul>
                	<li><a href="#">Sign In</a></li>
                    <li><a href="#">View Cart</a></li>
                    <li><a href="#">Wish List</a></li>
                    <li><a href="#">Track My Order</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
                <ul>
                	<li>Contact us</li>
                    <li>T: 01230 012312</li>
                    <li>E: <a href="mailto:info@abc.com">info@abc.com</a></li>
                    <li><a href="#">Site map</a></li>
                    <li><a href="#">Terms of use &amp; privacy</a></li>
                </ul>
            </div>
        </div>
        <div class="foot_bot">
        	<div class="emailsignup">
        	<h5>Join Our Mailing List</h5>
            <ul class="inp">
            	<li><input name="newsletter" type="text" class="bar" ></li>
                <li><a href="#" class="signup">Signup</a></li>
            </ul>
            <div class="clear"></div>
        </div>
            <div class="botm_links">
            	<ul>
                	<li class="first"><a href="#">Home</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
                <div class="clear"></div>
                <p>© 2010 DUMY. All Rights Reserved</p>
            </div>
            <div class="copyrights">
        	<p>
            	Registered address: County House, 1 New Road, BTQ5 8LZ. Company No. 6172469<br >
Office address: NewTrends Ltd, The Byre, Berry Pomeroy, Devon, TQ9 6LH
            </p>
        </div>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="topdiv">
        	<a href="#top" class="top">Top</a>
        </div>
        </div>
    </div>
</body>
</html>