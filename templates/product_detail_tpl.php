<?php //print_r($_SESSION["cart"]); ?>
<script type="text/javascript" src="js/ImageTooltip.js"></script>
<link href="js/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="js/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
  <?php 
      $d->reset();
      $sql="select ten,id from #_place_city where id order by stt,id asc";
      $d->query($sql);
      $tinh = $d->result_array();

      $d->reset();
      $sql="select ten,ten from #_place_dist where id_city='".$tinh[0]['id']."'  and  hienthi=1 order by id asc";
      $d->query($sql);
      $quan = $d->result_array();

  ?>
<script type="text/javascript">
function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

  $(document).ready(function(e) {
	  
	  
	
	    if($('a#size').length > 0){

		    price_size = $("a#size.active").attr("rel");
        idsize = $("a#size.active").attr("data-id");
       

  		  if(price_size <=0){
  		    $(".price_load").html('Liên hệ');
        }else{
          $(".price_load").html(number_format(price_size, 0, '.', '.')+' VNĐ');
          $("input[name='relsize']").val(price_size);
          $("input[name='idsize']").val(idsize);
          
        }
      }
	  

	  
	  $('a#size').click(function(){
    		price_size = $(this).attr("rel");
    		$(this).addClass('active').siblings().removeClass('active');
    		//$(this).css({'border':'2px solid #000','box-sizing':'border-box','background': 'red'});
    		idsize = $(this).data("id");
    		$("input[name='idsize']").val(idsize);
    		$("input[name='relsize']").val(price_size);
    		//alert(price_size);
    		$(".price_load").html(number_format(price_size, 0, '.', '.')+' vnđ');
	  })
	  
	 
      var color=0;
      $('.color_sp').click(function(){
          $('.color_sp').removeClass('active');
          $(this).addClass('active');
          color = $(this).data('rel');
      });
      $('.addcart').click(function(e) {
        var dem=0;
		    var psluong = $("input[name='sluong1']").val();
        var pid = $(this).parent().parent().find('.pid').val();
		
          if(psluong>0){
            dem++;
      			//var psize = $("a#size").data("id");
      			
      			//var pgia = $("a#size").attr("rel");
            if($('.chon_size').length > 0){
        		  var psize = $("input[name='idsize']").val();
        			var pgia = $("input[name='relsize']").val();
		        }else{
              var pgia = '<?=$row_detail['giaban']?>';
            }
            if($('.color_sp.active').length > 0){
              color = $('.color_sp.active').data('rel');
            }
            
            $.ajax({
              type: "POST",
              url: "ajax/add_giohang.php", 
              data: {pid:pid,psluong:psluong,psize:psize,pgia:pgia,color:color},
              success: function(string){
                  var getData = $.parseJSON(string);   
                  var result = getData.result_giohang;
                  var count = getData.count;
                    if(result > 0) {    
                        $.confirm({
                            boxWidth: '300px',
                            useBootstrap: false,
                            columnClass: 'small',
                            title: 'Thông báo',
                            content:'Thêm sản phầm vào giỏ hàng thành công!',
                            type: 'blue',
                            buttons: {
                                Thoát: function(){
                                }
                            },
                            
                        });

                      //alert('Bạn đã thêm thành công sản phẩm này vào giỏ hàng');
                      
                      $('.num_cart').html(count);                
                    }
                    if (result == -1){
                      $.confirm({
                          boxWidth: '300px',
                          useBootstrap: false,
                          columnClass: 'small',
                          title: 'Thông báo',
                          content:'Sản phẩm này không tồn tại',
                          type: 'blue',
                          buttons: {
                              Thoát: function(){
                              }
                          },
                          
                      });
                    }
                    if (result == 0){
                      $.confirm({
                          boxWidth: '300px',
                          useBootstrap: false,
                          columnClass: 'small',
                          title: 'Thông báo',
                          content:'Sản phẩm này đã có trong giỏ hàng',
                          type: 'blue',
                          buttons: {
                              Thoát: function(){
                              }
                          },
                          
                      });
                    }
                }          
              });
          }//end if
		
		
		

        if(dem<=0){
          alert('Nhập số lượng sản phẩm cần mua.');
        }
      });//end click
      $('.muangay').click(function(e) {
        var dem=0;
		var psluong = $("input[name='sluong1']").val();
	
        var pid = $(this).parent().parent().find('.pid').val();
		
		   if(psluong>0){
            dem++;
          //  var psize = $(this).parent().parent().parent().find('.ten1').data('rel');
           // var pgia = $(this).parent().parent().parent().find('.gia1').data('rel');
        if($('.chon_size').length > 0){
          var psize = $("input[name='idsize']").val();
          var pgia = $("input[name='relsize']").val();
        }else{
          var pgia = '<?=$row_detail['giaban']?>';
        }
        if($('.color_sp.active').length > 0){
          color = $('.color_sp.active').data('rel');
        }
          

			
			//alert(psize);
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
                    window.location.href ="http://<?=$config_url?>/thanh-toan.htm";
                    $('.bn_top_right a span').html(count);                
                  }
                    else if (result == -1)alert('Sản phẩm này không tồn tại');
                    else if (result == 0)alert('Sản phẩm này đã có trong giỏ hàng');
                }          
              });
          }//end if
		
		
       
        if(dem<=0){
          alert('Nhập số lượng sản phẩm cần mua.');
        }
        else{
            // alert('Bạn đã thêm thành công sản phẩm này vào giỏ hàng');
             window.location.href ="http://<?=$config_url?>/thanh-toan.htm";
        }
      });//end click
  });//end ready
</script>

<!-- <script>

   $(document).ready(function(){

    $('body,html').animate({

        scrollTop: 150

      }, 700);

    });

  </script> -->
<script language="javascript">
  function addtocart(pid){
    document.form_giohang.productid.value=pid;
    document.form_giohang.command.value='add';
    document.form_giohang.submit();
  }
</script>
<!-- 
<script>
$(document).ready(function() {

    var owl = $(".owl-demo-sanpham");
    owl.owlCarousel({
        items : 5, //10 items above 1000px browser width
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
</script> -->

<script>
  jQuery(document).ready(function(e){
    e(document).on("click",".plus, .minus",function(){
      var t=e(this).closest(".quantity").find(".qty"),n=parseFloat(t.val()),r=parseFloat(t.attr("max")),i=parseFloat(t.attr("min")),s=t.attr("step");
      if(!n||n==""||n=="NaN")n=0;
      if(r==""||r=="NaN")r="";if(i==""||i=="NaN")i=0;
      if(s=="any"||s==""||s==undefined||parseFloat(s)=="NaN")s=1;
      e(this).is(".plus")?r&&(r==n||n>r)?t.val(r):t.val(n+parseFloat(s)):i&&(i==n||n<i)?t.val(i):n>0&&t.val(n-parseFloat(s));
      t.trigger("change")
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function($) {
      if($('.w_phisip').length > 0){
        var id_city = "<?=$tinh[0]['ten']?>";
        var id_dist = "<?=$quan[0]['ten']?>";
        var soluong = $('#soluong').val();
        var trongluong = "<?=$row_detail['Weight']?>";
        $.ajax({
          url: 'ajax/loadphiship_detail.php',
          type: 'POST',
          data: {id_city:id_city,id_dist:id_dist,trongluong:trongluong,soluong:soluong},
          dataType:'json',
          success: function(data){
              $('#phivanchuyen').html(data.phiship);
          }
        });
      }

    $('.click_qh').click(function(event) {
        $(this).parents('.dist_city').find('.w_ds_dist_city').toggleClass('active');
    });

    $('.w_ds_dist_city').on('click','.item-level-list',function(){
        var id_city = $(this).attr('data-city'); 
        $.ajax({
          url: 'ajax/loaddist_detail.php',
          type: 'POST',
          data: {id_city: id_city},
          success: function(data){
            $('.w_ds_dist_city').html(data);
          }
        });
    });
    $('#soluong').change(function() {
      
        var id_city = $('.city_detail').text();
        var id_dist = $('.dist_detail').text();
        var soluong = $('#soluong').val();
        var trongluong = "<?=$row_detail['Weight']?>";
        console.log("changexx: "+"-id_city:"+id_city+"-id_dist:"+id_dist);
        $.ajax({
          url: 'ajax/loadphiship_detail.php',
          type: 'POST',
          data: {id_city:id_city,id_dist:id_dist,trongluong:trongluong,soluong:soluong},
          dataType:'json',
          success: function(data){
              
              $('#phivanchuyen').html(data.phiship);
          }
        });
    });
    $('.w_ds_dist_city').on('click','.item-level-cat',function(){
        var id_city = $(this).attr('data-city');
        var id_dist = $(this).attr('data-dist');
        var soluong = $('#soluong').val();
        var trongluong = "<?=$row_detail['Weight']?>";
        $('.w_ds_dist_city').removeClass('active');
        $('.city_detail').html(id_city);
        $('.dist_detail').html(id_dist);
        $.ajax({
          url: 'ajax/loadphiship_detail.php',
          type: 'POST',
          data: {id_city:id_city,id_dist:id_dist,trongluong:trongluong,soluong:soluong},
          dataType:'json',
          success: function(data){
              
              $('#phivanchuyen').html(data.phiship);
          }
        });
    });
    $('.w_ds_dist_city').on('click','.curren-city',function(){
        $.ajax({
          url: 'ajax/loadcity.php',
          type: 'POST',
          success: function(data){
            $('.w_ds_dist_city').html(data);
          }
        });
    });

  });
</script>

<?php 
  $sizesp = explode('|',$row_detail['size']);
  $giasp = explode('|',$row_detail['gia']);
  $hinhsizesp = explode('|',$row_detail['hinhsize']);
?>
<form name="form_giohang" action="index.php" method="post">
  <input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<div id="info">
 <div id="sanpham">
    <div class="table_info">
      
      <div class="content_1">
          <?=$bredrum?>
          <div class="flex_product_detail">
              <div class="frame_images" >
                    <div class="app-figure" id="zoom-fig">
                    <a href="<?=_upload_product_l.$row_detail['photo']?>" id="Zoom-1" class="MagicZoom" title="<?=$row_detail['ten_'.$lang]?> .">
                    <img src="<?=_upload_product_l.$row_detail['photo']?>" alt="<?=$row_detail['ten_'.$lang]?>" width="460" /></a>
                    </div>

                    <div class="selectors">
                    <?php include _template."layout/thumb.php";?>
                    </div>
              </div>
              <ul class="khung_thongtin">
                    <li><h1><?=$row_detail['ten_'.$lang]?></span></h1></li>
                    <li class="masp">Mã: <span><?=$row_detail['masp']?></span></li>
                    <li>
                      <div class="stat" data-id="<?=$row_detail['id']?>">
                        <?php//echo (($row_detail['rate'] / $row_detail['total']) / 100);?>
                        <span class="ui-rater">
                            <span class="ui-rater-starsOff" style="width:90px;"><span class="ui-rater-starsOn" style="width:<?php echo ($row_detail['rate']/$row_detail['total'])*9;?>px"></span></span>
                        </span>
                      </div>
                    </li>

                    <li class="gia_detail <?php if($row_detail['giacu'] > 0) echo "price_old"?>">

                        <div class="giacu_detail "><span><?php if($row_detail['giacu']==0) echo ""; else echo number_format ($row_detail['giacu'],0,",",".")." đ";?></span></div>

    			              <div class="price_load"><?php if($row_detail['giaban']==0) echo "Liên Hệ"; else echo number_format ($row_detail['giaban'],0,",",".")." đ";?></div>
                        <?php if($row_detail['giacu'] > 0){?>
                          <div class="giamgia_detail">Giảm <?=giamgia($row_detail['giacu'],$row_detail['giaban']);?></div>
                        <?php } ?>
                    </li>


                    <div class="pr_left">
  
                      <!-- <li class="baohanh_detail"><?=$row_detail['thuoctinh']?></li> -->
                        <li class="mausp w_propre">
                            <span>Vận chuyển:</span>
                            <div class="div_wrap">
                                <?php /* 
                                <?=$row_detail['thongtinthem_vi']?> 
                                */
                                $d->reset();
                                $sql= "select ten_$lang from #_baiviet where id='".$row_detail["id_tggiao"]."'";
                                $d->query($sql);
                                $ten_vchuyen = $d->fetch_array();
                                echo str_replace('%ngay%', $ten_vchuyen["ten_$lang"], $row_vchuyen["noidung_$lang"]);
                                ?>
                                <div class="w_phisip">
                                    <div class="lbl_vanchuyen">Vận chuyển tới 
                                        <div class="dist_city">
                                          <div class="click_qh">
                                            <span class="dist_detail"><?=$quan[0]['ten']?></span>, 
                                            <span class="city_detail"><?=$tinh[0]['ten']?></span>
                                            <svg class="mych-svg-icon icon-arrow-down" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0"><g><path d="m11 2.5c0 .1 0 .2-.1.3l-5 6c-.1.1-.3.2-.4.2s-.3-.1-.4-.2l-5-6c-.2-.2-.1-.5.1-.7s.5-.1.7.1l4.6 5.5 4.6-5.5c.2-.2.5-.2.7-.1.1.1.2.3.2.4z"></path></g></svg>
                                          </div>
                                            <div class="w_ds_dist_city">
                                                <ul class="w-level-list">
                                                    <?php foreach($tinh as $k){?>
                                                        <li class="item-level-list" data-city="<?=$k['ten']?>"><?=$k['ten']?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                         </div>
                                    </div>
                                    <div class="lbl_phivchuyen">Phí vận chuyển 
                                        <div id="phivanchuyen">Miễn phí</div>
                                    </div>
                                </div>
                            </div>
                        </li>
    



                       <?php if($row_detail['size']!=''&& $row_detail['gia']!=''){?>
                          <?php if(count($sizesp)>0){ ?>
                            <li class="chon_size w_propre">
                              <span>Chọn Size:</span>
                                <div id="span_size" class="div_wrap">
                                    <?php for($j=0;$j<count($sizesp);$j++){
                                      $pricesize=str_replace(',', '', $giasp[$j]);
                                      $imghinhsize=$hinhsizesp[$j];

                                      $myimg = ($deviceType == "computer")? _upload_baiviet_l.'0x300x2/'.$imghinhsize : _upload_baiviet_l.'0x200x2/'.$imghinhsize;
                                      echo '<a id="size" onMouseOver="doTooltip(event,\''.$myimg.'\');" onMouseOut="hideTip()" style="padding: 3px;" name="size" rel="'.$pricesize.'" data-id="'.($j+1).'" href="javascript:;" title="'.$sizesp[$j].'" alt="'.$sizesp[$j].'" data-rel="'.$sizesp[$j].'" class=" '.(($j==0)?'active':'').'">'.$sizesp[$j].'</a>';
                                    ?>
                                      <?php /* <a id="size" class="<?php if($j==0) echo'active';?>"  name="size" rel="<?=$pricesize?>" data-id="<?=$j+1?>"><?=$sizesp[$j]?></a> */?>
                                      <?php /* <a id="size" style="padding: 3px;" name="size" rel="<?=$pricesize?>" data-id="<?=$j+1?>" href="<?=_upload_baiviet_l?>0x300x2/<?=$imghinhsize?>" data-options="zoomWidth:300px;zoomHeight:300px;" title="<?=$sizesp[$j]?>" alt="<?=$sizesp[$j]?>" data-rel='<?=$sizesp[$j]?>' class="color_sp MagicZoom <?php if($j==0) echo'active';?>"><img src="<?= _upload_baiviet_l.$imghinhsize ?>" alt="<?=$sizesp[$j]?>" style="width: 30px;height: 30px;object-fit: fill"></a> */?>
                                      <?php /* onMouseOver="doTooltip(event,\'.$siteurl/wallpapers/thumbs/$wallpapername_$wallpaperid.jpg.\',"Image TITLE")" onMouseOut="hideTip()" */?>
                                    <?php } ?>
                                </div>   
                            </li>
                            <input type="hidden" name="idsize" value="">
                            <input type="hidden" name="relsize" value="">
                          <?php } ?>
                      <?php } ?>


                      <?php /* <?php if($row_detail['mausac']){ ?> <li class="mausp w_propre"> <span>Chọn màu:</span> <div class="div_wrap"> <?php $arr_mausac = explode('|', $row_detail['mausac']); for($i=0;$i<count($arr_mausac);$i++){?> <a alt="<?=$arr_mausac[$i]?>" data-rel='<?=$arr_mausac[$i]?>' class="color_sp <?php if($i==0) echo'active';?>"><?=$arr_mausac[$i]?></a> <?php } ?> </div> </li> <?php } ?> */?>

                      <?php 
                      if(!empty($hinhmau)){ ?>
                        <li class="mausp w_propre">
                          <span>Chọn màu:</span>
                          <div class="div_wrap">
                            <?php 
                            foreach($hinhmau as $key=>$value){ 
                              $myimg = ($deviceType == "computer")? _upload_baiviet_l.'0x300x2/'.$value['photo'] : _upload_baiviet_l.'0x200x2/'.$value['photo'];
                              echo '<a style="padding: 3px; " onMouseOver="doTooltip(event,\''.$myimg.'\');" onMouseOut="hideTip()" data-toggle="tooltip" title="'.$value['ten_vi'].'" alt="'.$value['ten_vi'].'" data-rel="'.$value['ten_vi'].'" href="javascript:;" class="color_sp '.(($key==0)?'active':'').'"><img src="'. _upload_baiviet_l.$value['photo'].'" alt="'.$value['ten_vi'].'" style="width: 30px;height: 30px;object-fit: fill"></a>';
                              ?>
                              <?php /*<a style="padding: 3px; " href="<?=_upload_baiviet_l?>0x300x2/<?=$value['photo']?>" data-options="zoomWidth:300px;zoomHeight:300px;" data-toggle="tooltip" title="<?=$value["ten_vi"]?>" alt="<?=$value["ten_vi"]?>" data-rel='<?=$value["ten_vi"]?>' class="color_sp MagicZoom <?php if($key==0) echo'active';?>"><img src="<?= _upload_baiviet_l.$value["photo"] ?>" alt="<?=$value["ten_vi"]?>" style="width: 30px;height: 30px;object-fit: fill"> <strong style="background: url(<?= _upload_baiviet_l.$value["photo"] ?>) no-repeat;width: 30px;height: 30px;   background-size: cover; display: block; margin: 0 auto;"></strong> </a>*/?>
                            <?php } ?>
                          </div>
                        </li>
                      <?php } ?>

                      <div class="clear"></div>
        		          <div class="cont_sg" style="display:none;height:0px;">
                        <input type="hidden" name="ten1" class="ten1" data-rel="0">
                        <input type="hidden" name="gia1" class="gia1" data-rel="<?=$row_detail['giaban']?>">
                      </div>
        				  
        				      <input type="hidden" value="<?=$row_detail['id']?>" class="pid">   
                      <?php if($com =='deal-gia-soc'){?>
        				          <?php if($thoigiantu <= time() && $thoigianden >= time() ) {?>
                    				<?php if($row_detail['soluongban'] < $row_detail['soluongdeal']){?> 
      
                      			  <div class="quantity w_propre">
                                  <span class="sluong" data-rel="1" title="<?=$row_detail['id']?>">Số Lượng:</span>
                                  <div class="div_wrap w_qty">
                                      <input type="button" class="minus" value="-">
                                      <input class="input-text qty sluong1 text" title="Qty" size="4" value="1" name="sluong1" id="soluong" max="50" min="1" step="1">
                                      <input type="button" class="plus" value="+">
                                  </div>
                              </div><!--end quantity-->
                                
                              <div class="buy_cart">
                                <div class="addcart" title="Mua hàng" rel="<?=$row_detail['id']?>">Thêm vào giỏ hàng</div>
                                <div class="muangay" title="Mua ngay" rel="<?=$row_detail['id']?>">Mua ngay</div>
                                <?= likelayout($row_detail['id'],true) ?>
                              </div><!--end buy_cart-->  
                            <?php }else{?>
                                <div class="btn-het-deal">Hết hàng</div>
                            <?php } ?>
                          <?php } ?>
                      <?php }else{?>
                          
                              <div class="quantity w_propre">
                                  <span class="sluong" data-rel="1" title="<?=$row_detail['id']?>">Số Lượng:</span>
                                  <div class="div_wrap w_qty">
                                      <input type="button" class="minus" value="-">
                                      <input class="input-text qty sluong1 text" title="Qty" size="4" value="1" name="sluong1" id="soluong" max="50" min="1" step="1">
                                      <input type="button" class="plus" value="+">
                                  </div>
                              </div><!--end quantity-->
                                
                                
                              <div class="buy_cart">
                                <div class="addcart" title="Mua hàng" rel="<?=$row_detail['id']?>">Thêm vào giỏ hàng</div>
                                <div class="muangay" title="Mua ngay" rel="<?=$row_detail['id']?>">Mua ngay</div>
                                <?= likelayout($row_detail['id'],true) ?>
                              </div><!--end buy_cart-->
                          <?php /* if($row_detail['soluongton'] > 0){?>
                          <?php }else{?>
                            <div class="btn-het-deal">Liên Hệ Để Mua Hàng</div>
                          <?php } */?>
                      <?php } ?>
                      <div class="w_chiase">
                          <span>Chia sẻ</span>
                          <div class="addthis_inline_share_toolbox"></div>
                      </div>
                      <?php if($user_post){?>
                      <div class="w_user_dang">
                         Code:
                          <?=$user_post['username'];?>
                      </div>
                      <?php } ?>
                    </div><!--end pr_left-->
              </ul>
          </div>
      </div>
      <?php if($row_detail['id_daily']){?>
         <?php 
            $d->reset();
            $sql = "select * from #_daily where hienthi=1 and id='".$row_detail['id_daily']."'";
            $d->query($sql);
            $row_daily = $d->fetch_array();


            $d->reset();
            $sql = "select ten_vi from table_city_list where id='".$row_daily['id_tinhthanh']."'";
            $d->query($sql);
            $row_tinhthanh = $d->fetch_array();

            $d->reset();
            $sql = "select id from table_product where id_daily='".$row_detail['id_daily']."'";
            $d->query($sql);
            $count_sp = $d->result_array();
          

        ?>
        <section class="section4">
            <div class="box-white">
                <div class="box-daily"> 
                    <div class="l_daily">
                        <div class="img_daily">
                            <img src="<?=_upload_hinhanh_l?><?=$row_daily['photo']?>" alt="<?=$row_daily['ten_'.$lang]?>">
                        </div>
                        <div class="info_l_daily">
                            <div class="ten_daily"><span><?=$row_daily['ten_'.$lang]?></span></div>
                            <p>Điện thoại: <span><?=$row_daily['dienthoai']?></span></p>
                            <p>Email: <span><?=$row_daily['email']?></span></p>
                        </div>
                    </div>
                    <div class="r_daily">
                        <p>Tỉnh thành: <span><?=$row_tinhthanh['ten_vi']?></span></p>
                        <p>Sản phẩm: <span><?=count($count_sp)?></span></p>
                    </div>
                </div>
            </div>
        </section>
      <?php } ?>

      <div class="section2">
          <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#home">
                  <span><img src="images/detail.png"></span>
                  <span>Chi tiết sản phẩm</span>
                </a>
              </li>
             
              <li>
                <a data-toggle="tab" href="#menu1"> 
                  <span><img src="images/giaohang.png"></span>
                  <span>Hình thức giao hàng</span>
                </a>
              </li>
              <li>
                <a data-toggle="tab" href="#menu2">
                  <span><img src="images/danhgia.png"></span>
                  <span>Đánh giá bình luận</span>
                </a>
              </li>
          </ul>

          <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                  <?php if($row_detail['thuoctinh']){?>
                    <?=$row_detail['thuoctinh']?>
                  <?php }else{?>
                      <div class="alert alert-danger" role="alert" style="font-family:'RobotoBold">
                        Nội dung đang cập nhật!
                      </div>
                  <?php } ?>
              </div>
              <div id="menu1" class="tab-pane fade">
                <?php if($row_vanchuyen['noidung_'.$lang]){?>
                  <?=$row_vanchuyen['noidung_'.$lang]?>
                <?php }else{?>
                    <div class="alert alert-danger" role="alert" style="font-family:'RobotoBold">
                      Nội dung đang cập nhật!
                    </div>
                <?php } ?>
              </div>
              <div id="menu2" class="tab-pane fade">
                 <div class="fb-comments" data-href="<?=getCurrentPageURL_CANO()?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>  
              </div>
          </div>      
      </div>

      <div class="sectinon3">

          <div class="danhmuc_pro clearfix">
                <div class="box-white">
                    <h3 class="tit-web">Sản phẩm khác cùng loại</h3>
                    <div class="box-content flex-sanpham chay_detail scroll">
                        <?php foreach($product_cungloai as $k){?>
                            <div class="item_sp">
                                <div class="zoom">
                                    <div class="hidden_img">
                                        <a href="<?=$com?>/<?=$k['tenkhongdau']?>.html">
                                            <img src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>" onerror="this.src='http://placehold.it/475x500';">
                                            <?php if($k['giacu'] > 0){?>
                                                <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                            <?php } ?>
                                         </a>
                                    </div>
                                </div>
                                <?php $giasp = explode('|',$k['gia']);?>
                                <?php
                                  $pricesize=str_replace(',', '', $giasp[0]);
                                  if($pricesize <=0){$pricesize = $k['giaban'];}
                                ?>
                                <div class="info_sp">
                                    <h3><a href="<?=$com?>/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                    <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                        <span><?php if($pricesize==0) echo _lienhe; else echo number_format ($pricesize,0,",",",")." VNĐ";?></span>
                                        <?php if($k['giacu']>0){?>
                                            <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="luotxem"><i class="fa fa-eye"></i> <?=$k['luotxem']+$k['luotxem2']?> lượt xem</div>
                                    <?= likelayout($k["id"]) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
          </div>

          <div class="danhmuc_pro clearfix">
                <div class="box-white">
                    <h3 class="tit-web">Sản phẩm cùng nghành hàng</h3>
                    <div class="box-content flex-sanpham chay_detail scroll">
                        <?php foreach($product_cungnganh as $k){?>
                            <div class="item_sp">
                                <div class="zoom">
                                    <div class="hidden_img">
                                        <a href="<?=$com?>/<?=$k['tenkhongdau']?>.html">
                                            <img src="<?=_upload_product_l?>475x500x2/<?=$k['photo']?>" alt="<?=$k['ten_'.$lang]?>" onerror="this.src='http://placehold.it/475x500';">
                                            <?php if($k['giacu'] > 0){?>
                                                <span class="giamgia"><?=giamgia($k['giacu'],$k['giaban'])?></span>
                                            <?php } ?>
                                         </a>
                                        
                                    </div>
                                </div>
                                <?php $giasp = explode('|',$k['gia']);?>
                                <?php
                                  $pricesize=str_replace(',', '', $giasp[0]);
                                  if($pricesize <=0){$pricesize = $k['giaban'];}
                                ?>
                                <div class="info_sp">
                                    <h3><a href="<?=$com?>/<?=$k['tenkhongdau']?>.html"><?=$k['ten_'.$lang]?></a></h3>
                                    <div class="giasp <?php if($k['giacu']<=0) echo 'none-price'?>">
                                        <span><?php if($pricesize==0) echo _lienhe; else echo number_format ($pricesize,0,",",",")." VNĐ";?></span>
                                        <?php if($k['giacu']>0){?>
                                            <span><?=number_format ($k['giacu'],0,",",",")." đ";?></span>
                                        <?php } ?>
                                    </div>
                                     <div class="luotxem"><i class="fa fa-eye"></i> <?=$k['luotxem']+$k['luotxem2']?> lượt xem</div>
                                     <?= likelayout($k["id"]) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
          </div>

      </div>

    </div>

</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'right',
    html: true
  });
});
</script>
<?php 
// <pre>Array
// (
//     [pick_province] => Hồ Chí Minh
//     [pick_district] => Quận 12
//     [province] => Hồ Chí Minh
//     [district] => Bình Chánh
//     [address] => 
//     [weight] => 1000
//     [value] => 5300000
// )
// $data = array(
//     "pick_province" => "Hồ Chí Minh",
//     "pick_district" => "Quận 12",
//     "province" => "Hà Nội",
//     "district" => "Ba Vì",
//     "address" => "P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ",
//     "weight" => 10000,
//     // "value" => 3000000,
// );
// $curl = curl_init();

// curl_setopt_array($curl, array(
//     CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_HTTPHEADER => array(
//         "Token: ".$config['key_ghtk'],
//     ),
// ));

// $response = curl_exec($curl);
// curl_close($curl);

// echo 'Response: ' . $response;
 ?>