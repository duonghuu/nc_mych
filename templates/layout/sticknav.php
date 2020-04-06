<sticknav>

<div class="nav nav-pills nav-stacked fixmenu">
	
<div class="giohang giohangri">
	<a href="thanh-toan.html">
		<?php if(count($_SESSION['cart'])>0){?><span class="tong_cart"><?=count($_SESSION['cart'])?></span><?php }?>
		<i class="glyphicon glyphicon-shopping-cart"></i>

	</br>
	Giỏ hàng
</a>
</div>

<div class="giohang giohangri">
	<a class="click_daxem">
		<i class="fa fa-eye" aria-hidden="true"></i>
	</br>
	Đã xem
</a>
<?php


 if($_SESSION['daxem']){ $sp_dx1 = $_SESSION['daxem']; ?>
<div class="daxem">
	<?php  foreach($sp_dx1 as $value){ 
		$d->reset();
		$d->query("select id,ten_$lang as ten,tenkhongdau,masp,giaban,giacu,photo,mota_$lang as mota,thumb from #_product where hienthi=1 and id = ".$value['productid']."  order by stt asc, id desc limit 0,20");
		$product_dx1 = $d->fetch_array();

		?>
		<div class="box_daxem">
			<div class="close_dx"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="img_dx">
				<a target="_blank" href="san-pham/<?=$product_dx1['tenkhongdau']?>.html" title="<?=$product_dx1[$i]['ten']?>">
					<img onerror="this.src='1x1.png';" class="lazy" src="1x1.png" data-src="<?=_upload_product_l.$product_dx1['thumb']?>" alt="<?=$product_dx1['ten']?>" onerror="this.src='upload/hinhanh/noimage.png'" />
					<h3><?=strip_tags(catchuoi($product_dx1['ten'],50))?></h3>
					<p class="gb">
					<?php if($product_dx1['giaban']==0) echo "Liên Hệ"; else echo number_format ($product_dx1['giaban'],0,",",".")." VND";?>
					</p>
					<?php if($product_dx1['giacu']>0){ ?>
					<p class="gc">
					Giá trước đây
					<?php if($product_dx1['giacu']==0) echo "Liên Hệ"; else echo number_format ($product_dx1['giacu'],0,",",".")." VND";?>
					</p>
					<?php } ?>
				</a>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>

</div>


</sticknav>

