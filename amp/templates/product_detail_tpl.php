<?php 

    $d->reset();
    $sql = "select thumb,id,photo from #_product_photo where hienthi=1 and type='product' and id_product='".$row_detail['id']."' order by stt,id desc ";
    $d->query($sql);
    $product_photos = $d->result_array();

?>
<div class="sub_main textWhite clearfix">
    <div class="lb_main clearfix">
        <h3><?=$row_detail['ten_'.$lang]?></h3>
    </div>
    <div class="cont_main clearfix">
        <amp-carousel width="512" height="384" layout="responsive" type="slides">
            <amp-img src="/<?=_upload_product_l.$row_detail['photo']?>" width="628" height="380" layout="responsive"></amp-img>
            <?php for ($i=0,$countha=count($product_photos); $i < $countha; $i++) {?>
            <amp-img src="/<?=_upload_product_l.$product_photos[$i]['photo']?>" width="628" height="380" layout="responsive"></amp-img>
            <?php }?>
        </amp-carousel>
		
		 <?php 
            $sizesp = explode('|',$row_detail['size']);
            $giasp = explode('|',$row_detail['gia']);
         ?>
		
        <div class="rightProdetail clearfix">
            
            <form id="order" method="GET" action="/amp/add_to_cart.php" target="_top">
                
                
                <div class="sub_fer clearfix">
                    <label>Số lượng: </label>
                    <input type="number" name="soluong" id="soluong_add" min="1" value="1" />
                </div>
                
                <div class="price_box clearfix">
                    Giá bán :
                    <strong class="price_detail">
                        <?php if($row_detail["giaban"]==0){?>
                          Liên Hệ
                        <?php }else{?>
                          <?php if($row_detail["giakm"]==0){?>
                            <?=number_format($row_detail["giaban"])?> VNĐ
                          <?php }else{?>
                            <b><?=number_format($row_detail["giaban"])?> VNĐ </b> - <?=number_format($row_detail["giakm"])?> VNĐ 
                          <?php }?>
                        <?php }?>
                    </strong>
                </div>
                <div class="button_add clearfix">
                    <input type="hidden" name="id_product" value="<?=$row_detail["id"]?>" />
                    <input type="submit" class="button button-primary" name="add-to-cart" value="Thêm vào giỏ hàng" />
                    <input type="submit" class="button button-primary" name="add-to-pay" value="Mua ngay" />
                </div>
            </form>
            
        </div>
        <div class="fullProdetail clearfix">
            <amp-accordion>
               
                <?php if($row_detail["thongtinthem_vi"]!=''){?>
                <section>
                    
                    <div><?=ampify($row_detail["thongtinthem_vi"])?></div>
                </section>
                <?php }?>
                <?php if($row_detail["mota_".$lang]!=''){?>
                <section>
                  
                    <div><?=ampify($row_detail["mota_".$lang])?></div>
                </section>
                <?php }?>
            </amp-accordion>

        </div>
        <div id="social">
            <amp-social-share type="twitter" width="30" height="22"></amp-social-share>
            <amp-social-share type="facebook" width="30" height="22" data-attribution=254325784911610></amp-social-share>
            <amp-social-share type="gplus" width="30" height="22"></amp-social-share>
            <amp-social-share type="email" width="30" height="22"></amp-social-share>
        </div>
        
        <!-- <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-colorscheme="light" data-width="100%" ></div>
        <style>.fb-comments, .fb-comments iframe[style], .fb-like-box, .fb-like-box iframe[style] {width: 100% !important;}.fb-comments span, .fb-comments iframe span[style], .fb-like-box span, .fb-like-box iframe span[style] {width: 100% !important;}</style> -->
    </div>
</div>
<?php if(count($product)!=0){?>
<div class="sub_main clearfix">
    <div class="lb_main clearfix">
        <h3>Sản phẩm cùng loại</h3>
    </div>
    <div class="cont_main_product clearfix">
        <?php foreach ($product as $key => $value) {?>
            <div class="item_product clearfix">
                <a href="/san-pham/<?=$value['tenkhongdau']?>.html" class="img_product">
                  <amp-img srcset="/<?=(($value['upload']!="") ? $value['upload'] : _upload_product_l).$value['photo']?>" width="307" height="185" layout="responsive"></amp-img>
                </a>
                <div class="tool_product clearfix">
                  <a href="/san-pham/<?=$value['tenkhongdau']?>.html" class="detail_tool">Chi tiết</a>
                  <a href="/amp/add_to_cart.php?id_product=<?=$value['id']?>&soluong=1&add-to-pay=muangay" class="addcart_tool">Mua ngay</a>
                </div>
                <h3 class="label_product"><?=$value['ten']?></h3>
                <p class="price">
                  <?php if($value['giacu']>0 && $value['giaban']>0){ ?>
                  <span class="giagoc">
                    <?=number_format($value['giacu']).' VND'?>
                  </span>
                  <span>
                    <?=number_format($value['giaban']).' VND'?>
                  </span>
                  <?php }else{ ?>
				  <?php if($value['giaban']==0) echo "Liên Hệ"; else echo number_format ($value['giaban'],0,",",".")." VND";?>
                  
                  <?php } ?>
                </p>
            </div>
        <?php }?>
    </div>
</div>
<?php }?>
