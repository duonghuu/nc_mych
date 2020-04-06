<script> var base_url = "https://<?=$config_url?>";</script>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<?php /* <link href="style.css" rel="stylesheet" type="text/css" />
<link href="js/fancybox3/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css"  media="screen" />
<link href="js/jssor/jssor.css" rel="stylesheet" type="text/css" >
<link href="css/slick.css" type="text/css" rel="stylesheet" /> */?>
<?php /* <link href="css/slick-theme.css" type="text/css" rel="stylesheet" /> */?>

<?php /* 

 */?>
<?php /* <!-- owl-carousel -->
<link href="js/owl.carousel/owl-carousel-sp/owl.carousel.css" rel="stylesheet">
<link href="js/owl.carousel/owl-carousel-sp/owl.theme.css" rel="stylesheet"> */?>
<?php /*?><link rel="stylesheet" href="js/slidedownmenu/slidedownmenu.css">
<script src="js/slidedownmenu/script.js"></script>
<?php */?>
<?php /* <link href="css/jquery.mmenu.all.css" ype="text/css" rel="stylesheet"  /> */?>
<?php if($template=="product_detail" || $source=="thanhtoan"){ ?>
   <link type="text/css" rel="stylesheet" href="plugins/confirm/jquery-confirm.css" />
 <?php } ?>

<?php if($source!="index"){ ?>
	<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />
<?php } ?>
<?php if($template=="product_detail"){ ?>
	<link type="text/css" rel="stylesheet" href="js/rate/style.css" />
<?php } ?>
<style type="text/css">
	body{
		font-family: Arial;
		font-size:14px;
		line-height:1.5;
		background:url(<?=_upload_hinhanh_l.$row_background['photo']?>) <?=$row_background['re_peat']?> <?=$row_background['tren']?> <?=$row_background['trai']?>;
		background-color:<?=$row_background['mauneen']?>;
		background-attachment:<?=$row_background['fix_bg']?>;
	}
	body >iframe{  display: none;
  visibility: hidden;}
  <?php if($source!='index'){?>
  .bg-index{padding-top: 0px;border-top: 0px;}
  <?php } ?>
</style>
