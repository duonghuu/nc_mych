<?php 
   $d->reset();
    $sql = "select * from #_baiviet where hienthi=1 and type='baiviet' order by stt,id desc";
    $d->query($sql);
    $bottom_sl = $d->result_array();
?>

<?php if($bottom_sl){?>
	<div class="margin-auto">
		<div class="box-white box-pa10">
			<div class="bottom_slider scroll">
				<?php foreach($bottom_sl as $k){?>
					<div class="item_bt_sl">
						<img src="<?=_upload_baiviet_l?>80x53x1/<?=$k['thumb']?>" alt="<?=$k['ten_'.$lang]?>">
						<a href="bai-viet/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>