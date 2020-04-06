<?php

	$d->reset();
	$sql = "select * from #_product_list where id='".$row_detail['id_list']."' ";
	$d->query($sql);
	$row_detail_list = $d->fetch_array();

	$d->reset();
	$sql = "select * from #_product_cat where id='".$row_detail['id_cat']."' ";
	$d->query($sql);
	$row_detail_cat = $d->fetch_array();

?>
<script type="text/javascript">
$(document).ready(function(){
	$('.cont-filter-attr input').click(function(){
		$('.cont-filter-attr input:checked').each(function(){
			var checkedValue = $(this).val();
			if(checkedValue){
				var id = $(this).val();
				link = link+''+id;
			}
		});
		window.location.href=link;
	});
});
</script>

<div class="dieuhuong">  

    <a href="trang-chu.html" itemprop="url" title="trang chủ"><span itemprop="title">Trang chủ</span></a>
    
	<?php if($row_detail_list['id']!=''){?>
		<a title="<?=$row_detail_list['ten_'.$lang]?>" itemprop="url" href="<?=$row_detail_cat['tenkhongdau']?>/"><span itemprop="title"><?=$row_detail_list['ten_'.$lang]?></span></a>
	<?php } ?>

	<?php if($row_detail_cat['id']!=''){?>
		<a title="<?=$row_detail_cat['ten_'.$lang]?>" itemprop="url" href="<?=$row_detail_list['tenkhongdau']?>/<?=$row_detail_cat['tenkhongdau']?>/"><span itemprop="title"><?=$row_detail_cat['ten_'.$lang]?></span></a>
	<?php } ?>

	<?php if($row_detail_item['id']!=''){?>
	<a title="<?=$row_detail_item['ten_'.$lang]?>" itemprop="url" href="<?=$row_detail_list['tenkhongdau']?>/<?=$row_detail_cat['tenkhongdau']?>/<?=$row_detail_item['tenkhongdau']?>/"><span itemprop="title"><?=$row_detail_item['ten_'.$lang]?></span></a>
	<?php } ?>

	<a title="<?=$row_detail['ten_'.$lang]?>" itemprop="url" href="san-pham/<?=$row_detail['id']?>/<?=$row_detail['tenkhongdau']?>.html"><span itemprop="title"><?=$row_detail['ten_'.$lang]?></span></a>
</div>
