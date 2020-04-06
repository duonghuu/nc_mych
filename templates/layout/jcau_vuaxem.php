<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.0-packed.js"></script>
<script type="text/javascript" language="javascript">
    $(function() {
        $('#foo5').carouFredSel({
            width: 1200,
            height: 'auto',
            prev: '#prev15',
            next: '#next15',
            auto: true,
            scroll: 1
        });
    });
</script>

<style type="text/css" media="all">
.list_carousel_5 {
	width: 1200px;
	float:left;
	position:relative;
	border:1px solid #dedede;
}
.list_carousel_5 ul {
	margin: 0;
	width: 1200px;
	padding: 0;
	list-style: none;
	display: block;
}
.list_carousel_5 li {
	display: block;
	float: left;
	width:200px;
	padding: 20px;
}
.list_carousel_5.responsive {
	width: auto;
	margin-left: 0;
}
.clearfix {
	float: none;
	clear: both;
}

.prev15{ width: 41px; height: 36px; position: absolute; z-index: 10; background: url(images/left.png) no-repeat; top: 50px; left: 20px;}
.next15{ width: 41px; height: 36px; position: absolute; z-index: 10; background: url(images/right.png) no-repeat; top: 50px; right: 20px;}
</style>
<div class="list_carousel_5">
	<a href="#prev15" id="prev15" class="prev15"></a>
	<a href="#next15" id="next15" class="next15"></a>
    <div class="clearfix"></div>
	<ul id="foo5">
	<?php 
     $count_daxem=count($_SESSION['daxem']);

     for($j=0;$j<$count_daxem;$j++){

      $d->reset();
      $sql = "select id,thumb,ten_$lang,giaban,tenkhongdau,giacu from #_product where id='".$_SESSION['daxem'][$j]['productid']."'  ";
      $d->query($sql);
      $sanpham_daxem = $d->fetch_array();
      ?>
      
        <li class="item_hot">
		<a href="san-pham/<?=$sanpham_daxem['id']?>/<?=$sanpham_daxem['tenkhongdau']?>.html">
			<span class="giamgia_hot">-<?=giamgia($sanpham_daxem['giacu'],$sanpham_daxem['giaban'])?></span>
			<img src="<?=_upload_product_l.$sanpham_daxem['thumb']?>" alt="<?=$sanpham_daxem['ten_'.$lang]?>" />
            <h3><?=$sanpham_daxem['ten_'.$lang]?></h3>
            <p class="giaban"><?php if($sanpham_daxem['giaban']==0) echo _lienhe; else echo number_format ($sanpham_daxem['giaban'],0,",",",")." VNĐ";?></p>
            <?php if($sanpham_daxem['giacu']!=0){?>
            <p class="giacu"><?php if($sanpham_daxem['giacu']==0) echo _lienhe; else echo number_format ($sanpham_daxem['giacu'],0,",",",")." VNĐ";?></p>
            <?php } ?>
        </a>
        </li>

        <?php } ?>

	</ul>
</div>
        
        
        
		
