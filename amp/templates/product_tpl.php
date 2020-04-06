<div class="sub_main clearfix">
  <div class="lb_main clearfix">
    <h3><?=$title_detail?></h3>
  </div>
  <div class="cont_main_product clearfix">
    <?php if(count($product)!=0){?>
      <?php foreach ($product as $j => $value) {
		  
		   $sizesp = explode('|',$value['size']);
                    $giasp = explode('|',$value['gia']);
		  
		  ?>
      <div class="item_product clearfix">
        <a href="/san-pham/<?=$value['tenkhongdau']?>.html" class="img_product">
          <amp-img srcset="/<?=(($value['upload']!="") ? $value['upload'] : _upload_product_l).$value['thumb']?>" width="307" height="185" layout="responsive"></amp-img>
        </a>
        <div class="tool_product clearfix">
          <a href="/san-pham/<?=$value['tenkhongdau']?>.html" class="detail_tool">Chi tiết</a>
          <a href="/amp/add_to_cart.php?id_product=<?=$value['id']?>&soluong=1&add-to-pay=muangay" class="addcart_tool">Mua ngay</a>
        </div>
        <h3 class="label_product"><?=$value['ten_'.$lang]?></h3>
        
      </div>
      <?php }?>
    <?php }else{?>
      <p><?=_dangcapnhat?></p>
    <?php }?>
  </div>
	<?php if($paging!=""){?>
	<div class="wrap_paging">
		<div class="paging clearfix"><?=$paging?></div>
	</div>
	<?php }?>
</div>
