
<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="owl-carousel/owl.theme.css">
<script src="owl-carousel/owl.carousel.js"></script>


<script>
$(document).ready(function() {
  $(".owl-example2").owlCarousel({
	 scrollPerPage:false,
	 navigation:false,
	 autoPlay:true,
	 responsive:true,
	 items:5
  });
});
</script>
<div class="title_main">

<h2 >
Sản Phẩm Đặc Biệt
</h2>

</div><!--title main-->
<div class="clear"></div>
<div id="slsp_dacbiet">
<div class="owl-carousel owl-example2">
	<?php for($i=0,$countsp=count($product);$i<$countsp;$i++){?>
	<div class="product"  >
	<a href="product/<?=$product[$i]["id"]?>/<?=$product[$i]["tenkhongdau"]?>.html" title="<?=$product[$i]["ten"]?>">
	<div class="product_img">
		<img src="<?=($product[$i]["thumb"]=="")?"images/noimage.png":_upload_sanpham_l.$product[$i]["thumb"]?>" alt="<?=$product[$i]["ten"]?>" />
		<div class="bong_mo">
				<p><?=$product[$i]["ten"] ?></p>
				<b>Màu sắc: </b><?=$product[$i]["mausac"]?> </br>
				<b>Đường Kính: </b><?=$product[$i]["duongkinh"]?> </br>
				<b>Chiều Dài: </b><?=$product[$i]["chieudai"]?> </br>
				<b>Loại Ren: </b><?=$product[$i]["loairen"]?> </br>
				<b>Chất Liệu: </b><?=$product[$i]["chatlieu"]?> </br>
				<b>Xuất Xứ: </b><?=$product[$i]["xuatxu"]?> </br>
				</div>
	</div>
	</a>
		<div class="clear"></div>
		<h3>
		<?=$product[$i]["ten"] ?>
		</h3>
	<a class="chitiet" href="product/<?=$product[$i]["id"]?>/<?=$product[$i]["tenkhongdau"]?>.html" title="<?=$product[$i]["ten"]?>">
	</a>
	</div><!--end product-->

	<?php }?>
	
</div>
</div><!--end slsp_dacbiet-->
	<!--phan trang-->
<script>
// PHƯƠNG THỨC LOAD KẾT QUẢ 
    function loadData(page,id_danhmuc){
        $("#loadbody").fadeIn("fast");  
        $.ajax
        ({
            type: "POST",
            url: "ajax_paging/ajax_paging.php",
            data: {page:page,id_danhmuc:id_danhmuc},
            success: function(msg)
            {
                $("#loadbody").fadeOut("fast");
            }
        });
    }
	
</script>
<!--end phan trang-->
<?php 
	$d->reset();
	$sql_product_danhmuc = "select id,ten,tenkhongdau from table_product_danhmuc where hienthi=1 order by stt,id desc ";
	$d->query($sql_product_danhmuc);
	$product_danhmuc=$d->result_array();
	 $countdm = count($product_danhmuc);
	
for($k=0;$k<=(int)($countdm/6) ;$k++){

?>
	<div class="clear"></div>
		<div class="title_danhmuc title_danhmuc<?=$k?>">
		<?php for($j=$k*6;$j<$countdm && $j< (6*$k)+6 ;$j++){?>
			<div class="title_danhmuc_sub <?=($j==$k*6)?"border_left":""?>"  >
				<a title="tab_danhmuc<?=$j.$k?>" data-val="<?=$product_danhmuc[$j]["id"]?>" >
					<?=$product_danhmuc[$j]["ten"]?>
				</a>
			</div>
		<?php }?>
		</div>
		<script>
	$(document).ready(function() {
		$(".content_danhmuc_tab<?=$k?> .hidden_tab").hide(); 
		$(".title_danhmuc<?=$k?> div:first").addClass("active_tab");
		$(".content_danhmuc_tab<?=$k?> div.hidden_tab:first").fadeIn();
		
		$('.title_danhmuc<?=$k?> a').click(function(e) {
			$("#loadbody").fadeIn("fast");
			e.preventDefault();        
			 $(".title_danhmuc<?=$k?> div").removeClass("active_tab");
			$(".content_danhmuc_tab<?=$k?> .hidden_tab").hide(); 
			$(this).parent().addClass("active_tab");
			$('#' + $(this).attr('title')).fadeIn();
			$("#loadbody").fadeOut("fast");
		});
	});
	  
	</script>

	<div class="clear"></div>
	<div class="content_danhmuc_tab content_danhmuc_tab<?=$k?>">
		
		
		<div class="hidden_tab"  id="tab_danhmuc<?=$j.$k?>" title="<?=$product_danhmuc[$j]["id"]?>">
			
			<div class="pagination"></div>
		</div><!--end hidden_tab-->
		
		<script>
		$().ready(function(){
			loadData(1,"#tab_danhmuc<?=$j.$k?>","<?=$product_danhmuc[$j]["id"]?>");	
		});
		
		</script>
		
	</div>

<?php }?>



	