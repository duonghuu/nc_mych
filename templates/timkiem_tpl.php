
<div id="info">
    <div id="sanpham">
        <div class="thanhsp"> <h2>Tìm Kiếm Sản Phẩm</h2> </div>

        <div class="khung">
		<?php if(count($product)!=0){?>
       <?php for($i=0, $count_product=count($product);$i<$count_product;$i++){  ?> 
 		<div class="sp1 <?php if(($i+1)%4==0){ echo 'last';}?>">
         <a href="san-pham/<?=$product[$i]['id']?>/<?=bodautv($product[$i]['maso_'.$lang])?>.html">
         <img src="<?=_upload_sanpham_l.$product[$i]['thumb']?>" alt="<?=$product[$i]['maso_'.$lang]?>" />
         <h3><?=$product[$i]['maso_'.$lang]?></h3>
         </a>
        </div>
        <?php }?>
		<?php } else {?><div style="text-align:center; color:#FF0000; font-weight:bold; font-size:22px; text-transform:uppercase;" >Chưa Có Tin Cho Mục này .</div> <?php }?>

      </div>
         <div class="paging"><?=$paging['paging']?></div> 
    </div>

   
  </div>