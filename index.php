<?php
session_start();
error_reporting(0);
@define ( '_template' , './templates/'); 
@define ( '_source' , './sources/');
@define ( '_lib' , './libraries/');
if(!isset($_SESSION['lang']))
{
	$_SESSION['lang']='vi';
}
$lang=$_SESSION['lang'];
if($lang=="")
{
	$lang='vi';
}
	//unset($_SESSION["lang"]);
include_once _lib."Mobile_Detect.php";
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
include_once _lib."config.php";
$config['arrayDomainSSL']=array("mych.vn"); 
// include_once _lib."checkSSL.php";
include_once _lib."constant.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";
include_once _source."lang_$lang.php";
include_once _lib."functions_giohang.php";
include_once _lib."file_requick.php";
include_once _lib."counter.php"; 
if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
	$pid=$_REQUEST['productid'];
	$soluong=1;
	addtocart($pid,$soluong);
	redirect("thanh-toan.htm");}
	if($_GET['lang']!=''){
		$_SESSION['lang']=$_GET['lang'];
		header("location:".$_SESSION['links']);
	} else {
		$_SESSION['links']=getCurrentPageURL();
	}
	//echo ($template);
//print_r($_SESSION['daxem']);
	if(isset($_SESSION['login']['id_tv']) && $_SESSION['login']['id_tv'] > 0){
	  $s_idtv = $_SESSION['login']['id_tv'];
	  $d->reset();
	  $d->setTable("member");
	  $d->setWhere("id", $s_idtv);
	  $d->select("splike");
	  $ds_like = $d->fetch_array();
	  $a_ds_like = array();
	  if(!empty($ds_like["splike"]))
	    $a_ds_like = explode(",", $ds_like["splike"]);
	 	$_SESSION["splike"] = $a_ds_like;
	}
	?>
	<!DOCTYPE html>
	<html lang="vi">
	<head>
		<meta charset="UTF-8">
		<link id="favicon" rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" />
		<title><?php if($title_bar!='') echo $title_bar; else echo $row_setting['title']; ?></title>
		<meta name="description" content="<?php if($description_bar!='') echo $description_bar; 
		else echo $row_setting['description']; ?>">
		<meta name="keywords" content="<?php if($keyword_bar!='') echo $keyword_bar; 
		else echo $row_setting['keywords']; ?>">
		<meta name="robots" content="noodp,index,follow" />
		<meta name="google" content="notranslate" />
		<meta name='revisit-after' content='1 days' />
		<meta name="ICBM" content="<?=$row_setting['toado']?>">
		<meta name="geo.position" content="<?=$row_setting['toado']?>">
		<meta name="geo.placename" content="<?=$row_setting['diachi_'.$lang]?>">
		<meta name="author" content="<?=$row_setting['ten_'.$lang]?>">
		<base href="//<?=$config_url?>/">
		<meta name="google-site-verification" content="0bmGf84p3aUIdKns-0UZRTWodX75HZiOYeBhDPza51U" />
		<meta name="google-site-verification" content="UGkbbDDlvNS-ZFkl73oNGAhbSQbf2SAlJHfU0ydUWao" />
		<meta name="google-site-verification" content="NLqrwyUW-Ka0RukiVT_5Ktx7e3pfUMrm4dALzr_K8B8" />
		<meta name="google-site-verification" content="mq_yvxw5krbWbJ8QEyT1h-AntWVXk9RTFCntDiVFQB8" />
		<meta name="google-site-verification" content="nIJiESq_H9vJAhgMYUaY7DlK4R1jsrn2E8ztSOw5Yyc" />
		<meta name="google-site-verification" content="UHLk7c5tzmtLGFeikW5R4QhzsKaLPX5N5aMRBIE9uLE" />
		<meta name="google-site-verification" content="N2uPQfBIGu7RIjCoRx2DhOrUjeCiD_5SxBdoZt7Wzyo" />
		<meta name="google-site-verification" content="G2urjFInr5Av62_A5Jp0vtK7_hv7uE9I-HMwVXLlNOU" />
		<meta name="google-site-verification" content="ZXpnr_N-3OVNUxGSBEVPJyAqrEFzhe_L9udDEUxQe6c" />
		<meta name="google-site-verification" content="3eI3NClOdQgDKMYNw-DtJ1bmiqcsTC-6l1JDACwJ6Z0" />
		
		<?php if($source=='product' || $source=='baiviet'){?>
			<link rel="amphtml" href="<?=getCurrentPageURL_AMP()?>" />
		<?php } ?>
		<?=$share_facebook?>
		<link rel="stylesheet" href="js/bootstrap/css/bootstrap.css">
		<link rel='stylesheet' id='font-awesome-css' href='fonts/font-awesome/css/font-awesome.min.css?ver=4.0.3' type='text/css' media='all' /> 
		<link rel='stylesheet' href='css/fonts.css' type='text/css' /> 
		<?php /* 
		<style><?php echo file_get_contents($Protocol.$config_url.'/css_optimize.php');?></style> 
		*/?>
		<?php  include _template."layout/css.php";?> 
			<?php /* <!-- Google Tag Manager -->
						<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
							new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
						j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
						'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','GTM-KSQHGG8');</script>
					<!-- End Google Tag Manager -->
					<!-- Google Tag Manager (noscript) -->
					<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KSQHGG8"
						height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
						<!-- End Google Tag Manager (noscript) --> */?>
		<?=$row_setting['analytics']?>
	</head>
	<body data-title="<?= $source."_"._template.$template ?>" onload="<?php if($_GET['com']=='lien-he'){ echo 'initialize()';}?>"   itemscope='itemscope' itemtype='//schema.org/WebPage'>
		<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 939927128;
			var google_custom_params = window.google_tag_params;
			var google_remarketing_only = true;
			/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
		<noscript>
			<div style="display:inline; visibility: hidden;">
				<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/939927128/?value=0&amp;guid=ON&amp;script=0"/>
			</div>
		</noscript>
		<div class="loading-page1 none"></div>
		<div id="loader-wrapper"><div class="loader"></div></div>
		<a href="<?=$row_setting['googleplus']?>?rel=author" title="<?=$row_setting['author']?>" class="visit_hidden" style="height:0px;display:none;" ><?=$row_setting['author']?></a>
		<div id="container" itemprop='mainContentOfPage' itemscope='itemscope' itemtype='//schema.org/WebPageElement'>
			<header id="header" class="clearfix">
				<?php include _template."layout/header.php"; ?>
	        	<!-- <div id="menu_mobi" class="clearfix"> 
			        <?php //include _template."layout/menu_mb.php";?>
			    </div> -->
			</header>
			<main id="main">
				<section id="content">
					<?php if($source=='index'){ ?>
						<div class="margin-auto">
							<div id="slide_show"> 
								<?php include _template."layout/slider.php";?> 
							</div>
						</div>
						<div class="warper <?php if($source=='index') echo 'bg-index';?>">
							<?php include _template.$template."_tpl.php";?>
						</div>
					<?php }else{?>
						<div class="warper bg-index">
							<div class="margin-auto">
								<?php include _template.$template."_tpl.php";?>
							</div>
						</div>
					<?php } ?>
				</section>
			</main>
			<footer id="footer">
				<?php include _template."layout/footer.php"; ?>
			</footer>
			<?php //include _template."layout/top_index.php"; ?>
			<?php include _template."layout/fixed_tab.php"; ?>
			<?php include_once _template."layout/sticknav.php";?>
			<?php include _template."layout/danhmuc_mb.php";?>
		</div>
		<?=$row_setting['vchat']?>
		<?php  include _template."layout/js.php";?> 
		<?php  include _template."layout/popup.php";?> 
	</body>
	</html>