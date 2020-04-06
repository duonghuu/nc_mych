<script type="text/javascript">
  $(document).ready(function(e) {
      $('.add_cart').click(function(e) {
            var psluong = 1;
            var pid = $(this).data('rel');
            var psize = 0;
            var pgia = $(this).parent().parent().data('rel');
            var color = 0;
            $.ajax({
              type: "POST",
              url: "ajax/add_giohang.php", 
              data: {pid:pid,psluong:psluong,psize:psize,pgia:pgia,color:color},
              success: function(string){
                  var getData = $.parseJSON(string);   
                  var result = getData.result_giohang;
                  var count = getData.count;
                  if(result > 0) {    
                    alert('Bạn đã thêm thành công sản phẩm này vào giỏ hàng');
                    
                    $('.bn_top_right a span').html(count);                
                  }
                    else if (result == -1)alert('Sản phẩm này không tồn tại');
                    else if (result == 0)alert('Sản phẩm này đã có trong giỏ hàng');
                }          
              });
      });//end click
  });//end ready
</script>

<script>
$(document).ready(function() {

    var owl = $(".owl-demo-sanpham");
    owl.owlCarousel({
        items : 4, //10 items above 1000px browser width
        itemsDesktop : [1040,3], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0
        itemsMobile : [400,1], // itemsMobile disabled - inherit from itemsTablet option
        autoPlay: false,
        scrollPerPage : 4,
        slideSpeed: 300,
        pagination:true,
         // navigationText: ["",""],
        navigation : false,
        slideSpeed : 300,
        paginationNumbers : true,
        paginationSpeed : 400,
      });
});
</script>


<div id="info">
<div id="sanpham">
<div class="khung">

        <div class="thanh_title"><h2>Sản phẩm cùng loại</h2></div><div class="clear"></div>
        <div>
      		<div class="clear" style="height:20px;"></div>
            <div>
            <?php 
                if(count($product)<=0) echo 'Nội dung đang cập nhật.....';
                else{
                for($j=0;$j<count($product);$j++){
                    
                    $sizesp = explode('|',$product[$j]['size']);
                    $giasp = explode('|',$product[$j]['gia']);
            ?>
            <div class="sp_form <?php if(($j+1)%5==0){ echo 'last';}?>" >
                <div class="product_images">
                    <div class="sp_xemnhanh" data-rel="<?=$product[$j]['giaban']?>">
                        <?php if($product[$j]['size']!=''&&$product[$j]['gia']!=''){ ?>
                        <div class="cont_sg"><div class="size">Size</div><div class="gia">Giá</div></div><div class="clear" style="width:80%;margin:0px auto;height:1px;background:#FFF;"></div>
                        <?php for($k=0;$k<count($sizesp);$k++){?>
                        <div class="cont_sg">
                            <div class="size"><label class="ten1" data-rel="<?=$k+1?>"><?=$sizesp[$k]?></label></div>
                            <div class="gia"><label class="gia1" data-rel="<?=$k+1?>"><?php echo number_format($giasp[$k],0,",",".")." VND";?></label></div>
                        </div>
                        <div class="clear" style="width:80%;margin:0px auto;height:1px;background:#FFF;"></div>
                        <?php } } ?>
                        <?php if($product[$j]['dungtich']!=0){ ?>
                            <div class="baohanh">Dung tích: <?=$product[$j]['dungtich']?> ml</div>
                        <?php } ?>
                        <?php if($product[$j]['trongluong']!=0){ ?>
                            <div class="baohanh">Trọng lượng: <?=$product[$j]['trongluong']?> g</div>
                        <?php } ?>
                        <?php if($product[$j]['baohanh_vi']!=''){ ?>
                            <div class="baohanh">Bảo hành: <?=$product[$j]['baohanh_vi']?></div>
                        <?php } ?>
                        <?php if($product[$j]['thongtin_vi']!=''){ ?>
                            <div class="baohanh">Công suất: <?=$product[$j]['thongtin_vi']?></div>
                        <?php } ?>
                        <?php if($product[$j]['thongtin_en']!=''){ ?>
                            <div class="baohanh">Xuất xứ: <?=$product[$j]['thongtin_en']?></div>
                        <?php } ?>
                       <div class="addcart">
                                 <a class="add_cart phongto fancybox.iframe " href="load_giohang.php" data-rel="<?=$product[$j]['id']?>"> Mua hàng </a>
                                </div>
                                <!-- <div class="sp_lq"><a href="san-pham-lien-quan/<?=$product[$j]['tenkhongdau']?>.html" title="<?=$product[$j]['ten_vi']?>">Sản phẩm liên quan</a></div> -->
                                <div class="ct_sp"><a href="san-pham/<?=$product[$j]['tenkhongdau']?>.html" title="<?=$product[$j]['ten_vi']?>">Xem chi tiết</a></div>
                    </div>
                    <a href="san-pham/<?=$product[$j]['tenkhongdau']?>.html"><img src="<?=_upload_product_l.$product[$j]['thumb']?>" alt="<?=$product[$j]['ten_'.$lang]?>" /></a>
                </div>
                <div class="sp_info">
                    <h3><?=$product[$j]['ten_'.$lang]?></h3>
                    <?php if($product[$j]['giacu']>$product[$j]['giaban']){ ?>
                        <div class="khuyenmai">-<?php echo round((($product[$j]['giacu']/$product[$j]['giaban'])*10),1); ?>&#37;</div>
                    <?php } ?>
                    <div class="giaban"><?php if($product[$j]['giaban']==0) echo "Liên Hệ"; else echo number_format ($product[$j]['giaban'],0,",",".")." VND";?></div>
                    <?php if($product[$j]['giacu']>0){ ?>
                        <div class="giacu">Giá trước đây <?php if($product[$j]['giacu']==0) echo "Liên Hệ"; else echo number_format ($product[$j]['giacu'],0,",",".")." VND";?></div>
                    <?php } ?>
                    <div class="clear"></div>
                    <div class="stat" data-id="<?=$product[$j]['id']?>" style="text-align:center;padding-top:7px;padding-bottom:10px;">
                        <span class="ui-rater">
                            <span class="ui-rater-starsOff" style="width:90px;"><span class="ui-rater-starsOn" style="width:<?php echo ($product[$j]['rate']/$product[$j]['total'])*9;?>px"></span></span><span class="review">&nbsp;(<?php if($product[$j]['total']>0) echo $product[$j]['total'];else echo '0'; ?> reviews)</span>
                        </span>
                    </div>
                </div>
            </div>
            <?php if(($j+1)%5==0) echo '<div class="clear" style="height:20px;"></div>'; ?>
            <?php } } ?>
        </div>
        <div class="clear"></div>
        <div class="paging"><?=$paging?></div> 
    </div>

</div><!-- .khung -->
</div><!-- #sanpham -->
</div><!-- #info -->

<h1 class="visit_hidden"><?=$row_setting['ten_'.$lang]?></h1>