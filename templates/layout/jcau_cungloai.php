<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.0-packed.js"></script>
<script type="text/javascript" language="javascript">
    $(function() {
        $('#foo4').carouFredSel({
            width: 1200,
            height: 'auto',
            prev: '#prev13',
            next: '#next13',
            auto: true,
            scroll: 1
        });
    });
</script>
<style type="text/css" media="all">
.list_carousel_4 {
	width: 1200px;
	float:left;
	position:relative;
	border-top:0px;
	background: url(images/bong_dm.png) no-repeat bottom center;
	padding-bottom:30px;
	margin-bottom:20px;
}
.list_carousel_4 ul {
	margin: 0;
	width: 1200px;
	padding: 0;
	list-style: none;
	display: block;
}
.list_carousel_4 li {
	display: block;
	float: left;
	width:200px;
	padding: 10px;
	margin: 20px 0px 0px 0px;
	transition: 0.5s;
	text-align:center;
	position:relative;
	top: 0px;
}
.list_carousel_4 li h3{ color: #006db9; text-transform: uppercase; font-size:14px;}
.list_carousel_4 li img{
	width:110px;
	height:110px;
	border-radius:100%;
	border:2px solid #006ab4;

}
.list_carousel_4 li:hover{ top: -20px; opacity:0.8;}
.list_carousel_4.responsive {
	width: auto;
	margin-left: 0;
}
.clearfix {
	float: none;
	clear: both;
}

.prev13{ width: 41px; height: 36px; position: absolute; z-index: 10; background: url(images/left.png) no-repeat; top: 50px; left: 20px;}
.next13{ width: 41px; height: 36px; position: absolute; z-index: 10; background: url(images/right.png) no-repeat; top: 50px; right: 20px;}
</style>
<?php
  $d->reset();
  $sql = "select * from #_product_list where hienthi=1 and type='product' order by stt,id desc";
  $d->query($sql);
  $row_list = $d->result_array();
?>
<div class="list_carousel_4">
	<!--<a href="#prev14" id="prev14" class="prev14"></a>
	<a href="#next14" id="next14" class="next14"></a>-->
    <div class="clearfix"></div>
	<ul id="foo4">
    <?php for($j=0,$count_ch=count($row_list);$j<$count_ch;$j++){?>
		<li>
		<a href="<?=$row_list[$j]['tenkhongdau']?>">
			<img src="<?=_upload_product_l.$row_list[$j]['thumb']?>" alt="<?=$row_list[$j]['ten_'.$lang]?>" />
            <h3><?=$row_list[$j]['ten_'.$lang]?></h3>
        </a>
        </li>
	<?php } ?>
	</ul>
</div>
        
        
        
		
