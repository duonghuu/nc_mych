<?php 
	$d->reset();
    $sql= "select ten_$lang,id,tenkhongdau,thumb2,thumb from #_product_list where hienthi=1 and danhmuc!=0 order by stt,id desc";
    $d->query($sql);
    $product_list_index = $d->result_array();

 ?>
<div class="danhmuc_mb scroll" id="danhmuc_mb">
	<?php foreach($product_list_index as $k =>$v){?>
	    <div class="item_list_mb">
	        <a class="boxlist_mb" href="san-pham/<?=$v['tenkhongdau']?>">
	            <img onerror="this.src='1x1.png';" class="lazy" src="1x1.png" data-src="<?=_upload_product_l?><?=$v['thumb']?>" alt="<?=$v['ten_'.$lang]?>">
	            <span class=""><?=$v['ten_'.$lang]?></span>
	        </a>
	    </div>
	<?php } ?>	
</div>

