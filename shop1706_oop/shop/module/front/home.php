        	<h4 class="heading colr">CÁC SẢN PHẨM NỔI BẬT</h4>
            <div id="prod_scroller">
            <a href="javascript:void(null)" class="prev">&nbsp;</a>
       	  <div class="anyClass scrol">
                <ul>
                <?php
					include('model/Model_Product.php');
					//Lay 10 SP noi bat nhat
					$p=new Product();
					$rs=$p->getAll(1,'`view` DESC',0);
					while($r=mysqli_fetch_assoc($rs))
					{
				?>
                        <li>
                            <a href="?mod=detail&id=<?php echo $r['id']  ?>"><img src="images/sanpham/<?php echo $r['img_url'] ?>" alt="" ></a>
                            <h6 class="colr"><?php echo $r['name'] ?></h6>
                            <p class="price bold"><?php echo number_format($r['price']) ?></p>
                            <a href="?mod=cart_process&act=1&id=<?php echo $r['id'] ?>" class="adcart">Add to Cart</a>
                        </li>
                <?php
					}
				?>
                </ul>
			</div>
            <a href="javascript:void(null)" class="next">&nbsp;</a>
        </div>
            <div class="clear"></div>
            <div class="listing">
            	<h4 class="heading colr"> CÁC SẢN PHẨM MỚI</h4>
                <ul>
                  <?php
					//Lay 20 SP moi nhat
					$rs=$p->getAll(1,'`id` DESC',0);
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
                        	<a href="?mod=cart_process&act=1&id=<?php echo $r['id'] ?>" class="adcart">Add to Cart</a>
                            <p class="price"><?php echo number_format($r['price']/1000000,2) ?> Tr</p>
                        </div>
                    </li>
                 <?php
					}
				 ?>
                </ul>
            </div>