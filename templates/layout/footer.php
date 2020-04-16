<?php
	
	$d->reset();
	$sql = "select noidung_$lang from #_company where type='footer' ";
	$d->query($sql);
	$footer = $d->fetch_array();

	$d->reset();
	$sql = "select thumb,link,ten_vi,photo_vi from #_photo where hienthi=1 and type='facebook' order by stt asc";
	$d->query($sql);
	$facebook = $d->result_array(); 
	
	$d->reset();
	$sql = "select id,type,ten_$lang,tenkhongdau from #_baiviet where hienthi=1 and type='gioithieu' and noibat<>0 order by stt asc";
	$d->query($sql);
	$result_about = $d->result_array();

	$d->reset();
	$sql = "select id,type,ten_$lang,tenkhongdau from #_baiviet where hienthi=1 and type='hotrokhachhang' and noibat<>0 order by stt asc";
	$d->query($sql);
	$result_hotro = $d->result_array();

	$d->reset();
	$sql = "select id,type,ten_$lang,photo_$lang,thumb from #_photo where hienthi=1 and type='top_footer' limit 0,1";
	$d->query($sql);
	$top_footer = $d->fetch_array();

    $d->reset();
    $sql="select id,thumb,photo,ten_$lang,noidung_$lang,tenkhongdau from table_baiviet where hienthi=1 and type='header' order by id,stt desc";
    $d->query($sql);
    $resutl_tf=$d->result_array();

    $d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='img-thanhtoan'";
    $d->query($sql_banner_top);
    $img_thanhtoan = $d->fetch_array();

    $d->reset();
    $sql_banner_top= "select photo_vi from #_photo where type='img-vanchuyen'";
    $d->query($sql_banner_top);
    $img_vanchuyen = $d->fetch_array();

    $d->reset();
    $sql_banner_top= "select photo_vi,ten_$lang,link from #_photo where type='img-bocongthuong'";
    $d->query($sql_banner_top);
    $img_bct = $d->fetch_array();
	
	
?>

<?php /*
<div class="top_footer">
	<div class="box_top_footer">
		<div class="content_top_footer">
	
			<div class="top_footer_left">
				<ul class="ul_top_footer">
					<?php for($i=0;$i<count($resutl_tf);$i++){ ?>
					<li><a href="chinh-sach/<?=$resutl_tf[$i]['tenkhongdau']?>.html" title="<?=$resutl_tf[$i]['ten_vi']?>"><?=$resutl_tf[$i]['ten_vi']?></a></li>
					<?php } ?>
				</ul>
			</div>
		
			
			<div class="top_footer_right">
				<div class="hotline_footer">
					<span><?=$row_setting['hotline']?></span>
				</div>
				<div class="clear"></div>
				<div class="share">
					<?php for($i=0;$i<count($facebook);$i++){ ?>
						<a href="<?=$facebook[$i]['link']?>" title="<?=$facebook[$i]['ten_vi']?>"><img src="<?=_upload_hinhanh_l.$facebook[$i]['thumb']?>" alt="<?=$facebook[$i]['ten_vi']?>"></a>
					<?php } ?>
				</div>
			</div>
			<?php 
		</div>
	</div>
</div>*/ ?>	
<div id="bottom" class="clearfix">
	<div class="box_bottom">
		<div class="content_box_bottom">
			<div class="content_bottom content1">
				
				<div class="flex_ft_mb">
					<ul>
						<h3>Hỗ trợ khách hàng</h3>
						<?php for($i=0;$i<count($result_hotro);$i++){ ?>
						<li><a href="ho-tro/<?=$result_hotro[$i]['tenkhongdau']?>.html" title="<?=$result_hotro[$i]['ten_vi']?>"><?=$result_hotro[$i]['ten_vi']?></a></li>
						<?php } ?>
					</ul>
					<?php /* 
					<div class="tt_ft"><?=$footer['noidung_'.$lang]?></div> 
					*/?>
				</div>
			</div>
			<div class="content_bottom content2">
				<h3>Về MYCH.VN</h3>
				<ul>
					<?php for($i=0;$i<count($result_about);$i++){ ?>
					<li><a href="gioi-thieu/<?=$result_about[$i]['tenkhongdau']?>.html" title="<?=$result_about[$i]['ten_vi']?>"><?=$result_about[$i]['ten_vi']?></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="content_bottom content3">
				<div class="flex_ft_mb">
					<div>
						<h3>Thanh toán</h3>
						<div class="img_thanhtoan">
							<img src="<?=_upload_hinhanh_l?><?=$img_thanhtoan['photo_vi']?>" alt="<?=$row_setting['ten_'.$lang]?>">
						</div>
					</div>
					<div>
						<h3>Đơn vị vân chuyển</h3>
						<div class="img_vanchuyen">
							<img src="<?=_upload_hinhanh_l?><?=$img_vanchuyen['photo_vi']?>" alt="<?=$row_setting['ten_'.$lang]?>">
						</div>
					</div>
				</div>
			</div>
			<div class="content_bottom content4">
                <h3 class="dangkymail">Đăng ký nhận tin</h3>
				<form action="dang-ky.html" method="post" name="dangkymail" class="dangkymail">
			   		<input name="email" type="text" class="input" placeholder="Nhập email của bạn..."><div class="clear"></div>
			   		<button type="button" name="gioitinh">Nam</button>
			   		<button type="button" name="gioitinh">Nữ</button>
			   	</form>
			   	<div class="img_bct">
			   		<a href="<?=$img_bct['link']?>">
						<img src="<?=_upload_hinhanh_l?><?=$img_bct['photo_vi']?>" alt="<?=$img_bct['ten_'.$lang]?>">
					</a>
				</div>
			</div>
		</div>
		<div class="tt_ft2"><?=$footer['noidung_'.$lang]?></div>
		<?php /* 
		<div class="thongke">
					2019 Copyright © Mych.vn.
				</div> 
		*/?>
	</div>
</div>