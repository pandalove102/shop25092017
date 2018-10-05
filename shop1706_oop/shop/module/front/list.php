        	<h4 class="heading colr">Featured Products</h4>
            <div class="small_banner">
            	<a href="#"><img src="images/small_banner.gif" alt="" ></a>
            </div>
            <div class="sorting">
            <?php 
				$cid=intval($_GET['cid']);//Loai hien tai
				if($cid=='')$cid=1;
				
				$page=$_GET['page'];//Trang hien tai
				if($page<1)$page=1;
				
				$sort=$_GET['sort'];
				if($sort=='')$sort=1;
				
				//Tinh so trang
				//Su dung model Product
				include('model/Model_Product.php');
				$p=new Product();
				$cnt=$p->countProduct($cid);
				
				$nop=ceil($cnt/20);
				if($page>$nop && $nop>0)$page=$nop;
				
			?>
            	<p class="left colr"><?php echo $cnt ?> Item(s)</p>
                <ul class="right">
                  <li class="text">Page
                   	  <a href="?mod=list&cid=<?php echo $cid ?>&page=1&sort=<?php echo $sort ?>" class="colr" title="Trang đầu">&lt;&lt;</a> 
                   	  <a href="?mod=list&cid=<?php echo $cid ?>&page=<?php echo $page-9 ?>&sort=<?php echo $sort ?>" class="colr" title="Nhóm trang trước">&lt;</a>                        
                    <?php
						for($i=$page-4;$i<=$page+4;$i++)
						if($i>=1 && $i<=$nop)
						{
					?>
                       	  <a href="?mod=list&cid=<?php echo $cid ?>&page=<?php echo $i ?>&sort=<?php echo $sort ?>" class="colr <?php if($i==$page)echo 'current' ?>"><?php echo $i ?></a> 
					<?php
						}
					?>
                   	  <a href="?mod=list&cid=<?php echo $cid ?>&page=<?php echo $page+9 ?>&sort=<?php echo $sort ?>" class="colr" title="Nhóm trang sau">&gt;</a> 
                      <a href="?mod=list&cid=<?php echo $cid ?>&page=<?php echo $nop ?>&sort=<?php echo $sort ?>" class="colr" title="Trang cuối">&gt;&gt;</a> 
                    </li>
                </ul>
                <div class="clear"></div>
                <p class="left">View as: <a href="#" class="bold">Grid</a>&nbsp;<a href="#" class="colr">List</a></p>
                <ul class="right">
                	<li class="text">
                    	Sort by Position
                    	<a <?php if($sort<3)echo 'class="current"' ?> href="?mod=list&cid=<?php echo $cid ?>&sort=<?php if($sort==1) echo 2;else echo 1 ?>" class="colr">Price 
						<?php 
								if($sort==1) echo '<img src="images/asc.png" alt="asc">'; 
								if($sort==2) echo '<img src="images/desc.png" alt="desc">'; 
						?>
                        </a> | 
                        <a <?php if($sort>=3)echo 'class="current"' ?> href="?mod=list&cid=<?php echo $cid ?>&sort=<?php if($sort==3) echo 4;else echo 3 ?>" class="colr">View 
                        <?php 
								if($sort==3) echo '<img src="images/asc.png" alt="asc">'; 
								if($sort==4) echo '<img src="images/desc.png" alt="desc">'; 
						?>
                        </a> 
                    </li>
                </ul>
          	</div>
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
					$rs=$p->getAll("`category_id`=$cid",$order,$pos);
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