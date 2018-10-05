            <?php
				$id=intval($_GET['id']);
				if($id=='')$id=1;
				//Lay thong tín 1 san pham
				$sql='select * from `nn_product` where `id`='.$id;
				$rs=mysqli_query($link,$sql);
				$r=mysqli_fetch_assoc($rs);
			?>
        	<h4 class="heading colr"><?php echo $r['name']?></h4>
            <div class="prod_detail">
            	<div class="big_thumb">
                	<div id="slider2">
                        <div class="contentdiv">
                        	<img src="images/sanpham/<?php echo $r['img_url']?>" alt="" >
                            <a rel="example_group" href="images/sanpham/<?php echo $r['img_url']?>" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                      </div>
                        <!--<div class="contentdiv">
                            <img src="images/detail_img2.gif" alt="" >
                            <a rel="example_group" href="images/watch.jpg" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                        </div>
                        <div class="contentdiv">
                            <img src="images/detail_img3.gif" alt="" >
                            <a rel="example_group" href="images/watch.jpg" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                        </div>
                        <div class="contentdiv">
                        	<img src="images/detail_img4.gif" alt="" >
                            <a rel="example_group" href="images/watch.jpg" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                        </div>
                        <div class="contentdiv">
                        	<img src="images/detail_img5.gif" alt="" >
                            <a rel="example_group" href="images/watch.jpg" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                        </div>
                      <div class="contentdiv">
                        	<img src="images/detail_img6.gif" alt="" >
                            <a rel="example_group" href="images/watch.jpg" title="Lorem ipsum dolor sit amet, consectetuer adipiscing elit." class="zoom">&nbsp;</a>
                      </div>-->
                    </div>
                    <a href="javascript:void(null)" class="prevsmall"><img src="images/prev.gif" alt="" ></a>
                    <div style="float:left; width:189px !important; overflow:hidden;">
                    <div class="anyClass" id="paginate-slider2">
                        <ul>
                            <li><a href="#" class="toc"><img src="images/sanpham/<?php echo $r['img_url']?>" alt="" ></a></li>
                           <!-- <li><a href="#" class="toc"><img src="images/detail_img2_small.gif" alt="" ></a></li>
                            <li><a href="#" class="toc"><img src="images/detail_img3_small.gif" alt="" ></a></li>
                            <li><a href="#" class="toc"><img src="images/detail_img4_small.gif" alt="" ></a></li>
                            <li><a href="#" class="toc"><img src="images/detail_img5_small.gif" alt="" ></a></li>
                            <li><a href="#" class="toc"><img src="images/detail_img6_small.gif" alt="" ></a></li>-->
                        </ul>
                    </div>
                    </div>
                    <a href="javascript:void(null)" class="nextsmall"><img src="images/next.gif" alt="" ></a>
                    <script type="text/javascript" src="js/cont_slidr.js"></script>
                </div>
                <div class="desc">
                	<div class="quickreview">
                            <a href="#" class="bold black left"><u>Be the first to review this product</u></a>
                            <div class="clear"></div>
                            <p class="avail"><span class="bold">Availability:</span> <?php echo $r['qty']?></p>
                          <h6 class="black">Quick Overview</h6>
                        <div>
                        	<?php echo $r['desc']?>
                        </div>
                    </div>
                    <div class="addtocart">
                    	<h4 class="left price colr bold"><?php echo number_format($r['price'])?></h4>
                            <div class="clear"></div>
                            <ul class="margn addicons">
                                <li>
                                    <a href="#">Add to Wishlist</a>
                                </li>
                                <li>
                                    <a href="#">Add to Compare</a>
                                </li>
                        	</ul>
                            <div class="clear"></div>
                        <ul class="left qt">
                   	    <li class="bold qty">QTY</li>
                            <li><input name="qty" type="number" min="1" value="1" id="qty" class="bar" ></li>
                            <li><a onclick="window.location='?mod=cart_process&act=1&id=<?php echo $id ?>&qty='+$('#qty').val()" href="#" class="simplebtn"><span>Add To Cart</span></a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="prod_desc">
                	<h4 class="heading colr">Product Description</h4>
                    <div>
                    	<?php echo $r['detail']?> 
                    </div>
                </div>
            </div>
            <div class="listing">
            	<h4 class="heading colr">New Products for March 2010</h4>
                <ul>
                  <?php
				  	$cid=$r['category_id'];
					//Lay 20 SP moi nhat cùng loại (khác sp hiện tại)
					$sql="select `id`,`name`,`img_url`,`price` from `nn_product`
						where `category_id`=$cid  AND `id`!=$id
					 	order by `id` DESC limit 0,20";
					$rs=mysqli_query($link,$sql);
					$i=1;
					while($r=mysqli_fetch_assoc($rs))
					{
				?>
                	<li <?php if($i%4==0)echo 'class="last"';$i++ ?>>
                    	<a href="?mod=detail&id=<?php echo $r['id']  ?>" class="thumb"><img src="images/sanpham/<?php echo $r['img_url'] ?>" alt="" ></a>
                        <h6 class="colr"><?php echo $r['name'] ?></h6>
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
                            <p class="price"><?php echo number_format($r['price']/1000000,2) ?> Tr</p>
                        </div>
                    </li>
                 <?php
					}
				 ?>
                </ul>
            </div>
            <div class="tags_big">
            	<h4 class="heading colr">COMMENTS</h4>
                <?php
					$sql='SELECT `name` , `content` , a.`create_at`,`star`
							FROM `nn_comment` a, `nn_user` b
							WHERE a.`user_id` = b.`id`
							AND `product_id` ='.$id;
					$rs=mysqli_query($link,$sql);
					while($r=mysqli_fetch_assoc($rs))
					{
				     	echo $r['name'],' (',$r['star'],')<br>',$r['content'],'-',date('d/m/Y H:i:s',strtotime($r['create_at'])),'<br><br>';           			
					}
					if(isset($_SESSION['id']))
					{
				?>
                	<hr>
                    <p>Add Your comment:</p>
                    <span>
                    <form action="?mod=comment" method="post" id="comment">
                    	<select name="star">
                        	<option value="1">1 star</option>
                            <option value="2">2 stars</option>
                            <option value="3">3 stars</option>
                            <option value="4">4 stars</option>
                            <option selected value="5">5 stars</option>
                        </select><br />
                        <textarea name="content" class="bar" id="content" required ></textarea>
                        <input type="hidden" name="product_id" value="<?php echo $id ?>">
                    </form>
                    </span>
                  <div class="clear"></div>
                    <span><a href="javascript:document.getElementById('comment').submit()" class="simplebtn"><span>Add Comment</span></a></span>
               <?php 
					}
			   ?>
            </div>
            <div class="clear"></div>