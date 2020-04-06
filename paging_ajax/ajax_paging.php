<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	
	@define ( '_lib' , '../libraries/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";;
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	include_once "class_paging_ajax.php";
    
	$d = new database($config['database']);

	
	if(isset($_POST["page"]))
    {
	$paging = new paging_ajax();
	
	$paging->class_pagination = "pagination";
	$paging->class_active = "active";
	$paging->class_inactive = "inactive";
	$paging->class_go_button = "go_button";
	$paging->class_text_total = "total";
	$paging->class_txt_goto = "txt_go_button";
    $paging->per_page = 8; 	
    $paging->page = $_POST["page"];
    $paging->text_sql = "select ten_vi,id,thumb,tenkhongdau,giaban,giacu,gia,size,baohanh_vi,total,rate,thongtin_vi,thongtin_en,dungtich,trongluong,thuoctinh from table_product where hienthi=1 and id_list=".$_POST["id_danhmuc"]." and noibat<>0 ORDER BY RAND()";
    $result_pag_data = $paging->GetResult();
	$message = '';
	$paging->data = "" . $message . "";
    }
	 
?>

<script type="text/javascript">
// $(document).ready(function(e) {
// 	$('.hover_sp').hover(function(){
//         $(this).find('.sp_xemnhanh').fadeIn(550);
//     },function(){
//         $(this).find('.sp_xemnhanh').fadeOut(350);
//     });

// });
</script>
<?php
	$p=0;
	while ($row = mysql_fetch_array($result_pag_data)) { ?>  
		<?php 	        
		        $sizesp = explode('|',$row['size']);
		        $giasp = explode('|',$row['gia']);
		?>
		<div class="sp_form <?php if(($p+1)%4==0){ echo 'last';}?> hover_sp" >
		    <div class="product_images">
			<?php /*?>
		        <div class="sp_xemnhanh" data-rel="<?=$row['giaban']?>">
		            <?php if($row['size']!=''&&$row['gia']!=''){ ?>
		            <div class="cont_sg"><div class="size">Size</div><div class="gia">Giá</div></div><div class="clear" style="width:80%;margin:0px auto;height:1px;background:#FFF;"></div>
		            <?php for($k=0;$k<count($sizesp);$k++){?>
		            <div class="cont_sg">
		                <div class="size"><label class="ten1" data-rel="<?=$k+1?>"><?=$sizesp[$k]?></label></div>
		                <div class="gia"><label class="gia1" data-rel="<?=$k+1?>"><?php echo number_format($giasp[$k],0,",",".")." VND";?></label></div>
		            </div>
		            <div class="clear" style="width:80%;margin:0px auto;height:1px;background:#FFF;"></div>
		            <?php } } ?>
					
					
		            <div class="baohanh"><?=$row['thuoctinh']?></div>
					

                 <div class="addcart">
                    <a class="add_cart phongto fancybox.iframe " href="load_giohang.php" data-rel="<?=$row['id']?>"> Mua hàng </a>
                 </div>
				 
                 <div class="sp_lq"><a href="san-pham-lien-quan/<?=$row['tenkhongdau']?>.html" title="<?=$row['ten_vi']?>">SP cùng loại</a></div>
				 
                 <div class="ct_sp"><a href="san-pham/<?=$row['tenkhongdau']?>.html" title="<?=$row['ten_vi']?>">Xem chi tiết</a></div>
		        </div>
			<?php */?>	
		        <a href="san-pham/<?=$row['tenkhongdau']?>.html"><img src="<?=_upload_product_l.$row['thumb']?>" alt="<?=$row['ten_'.$lang]?>" /></a>
		    </div>
		    <div class="sp_info">
		        <h3><?=$row['ten_vi']?></h3>
		        <?php if($row['giacu']>$row['giaban']){ ?>
		            <div class="khuyenmai">-<?php echo round((($row['giacu']/$row['giaban'])*10),1); ?>&#37;</div>
		        <?php } ?>
		        <div class="giaban"><?php if($row['giaban']==0) echo "Liên Hệ"; else echo number_format ($row['giaban'],0,",",".")." VND";?></div>
		        <?php if($row['giacu']>0){ ?>
		            <div class="giacu">Giá trước đây <?php if($row['giacu']==0) echo "Liên Hệ"; else echo number_format ($row['giacu'],0,",",".")." VND";?></div>
		        <?php } ?>
		        <div class="clear"></div>
		        <div class="stat" data-id="<?=$row['id']?>" style="text-align:center;padding-top:7px;padding-bottom:15px;">
		            <span class="ui-rater">
		                <span class="ui-rater-starsOff" style="width:90px;"><span class="ui-rater-starsOn" style="width:<?php echo ($row['rate']/$row['total'])*9;?>px"></span></span><span class="review">&nbsp;(<?php if($row['total']>0) echo $row['total'];else echo '0'; ?> reviews)</span>
		            </span>
		        </div>
		    </div>
		</div>
		<?php if(($p+1)%4==0){ echo'<div class="clear"></div>'; } ?>
<?php 
	$p++; }
	if($p==0) echo "<span style='color:#000'>Nội dung đang cập nhật......</span>"; 
	else{ ?>
		<div class="clear" style="height:40px;"></div>
	<?php 
		echo $paging->Load();
	} ?>