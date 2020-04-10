<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	include_once _lib."Mobile_Detect.php";
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	// if($deviceType != 'computer'){
	// 	@define ( '_template' , './m/');
		
	// }else{
	// 	@define ( '_template' , './templates/');
	// }
	
	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];
	
	//unset($_SESSION["lang"]);
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";

	include_once _lib."file_requick.php";
	include_once _lib."counter.php"; 

	if(!empty($_POST) && $_POST["id_product"]!='' && $_POST["soluong"]!='' ){
		include_once _lib."functions_giohang.php"; 	
		if(addtocart(intval($_POST["id_product"]),intval($_POST["soluong"]),intval($_POST["color"]),intval($_POST["size"]))){
			if($_POST["type"]!='' && $_POST["type"]=='thanh-toan'){
				redirect("https://".$config_url."/thanh-toan.html");
			}else{
				redirect("https://".$config_url."/thanh-toan.html");
			}

		}
	}
?>
<!DOCTYPE html>
<html ⚡ lang="<?=$lang?>">
<head itemscope itemtype="https://schema.org/WebSite">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include _template."layout/base_meta.php";?>
<?php include _template."layout/base_css.php";?>
<?php include _template."layout/base_js_amp.php";?>
</head>

<body <?php if($_GET['com']=='lien-he'){?> onLoad="initialize()"<?php }?>>
<?php include _template."layout/base_analytics.php";?>

<?php include _template."layout/nav_mobile.php";?>
<div id="full_content" class="clearfix">
	<?php include _template."layout/header.php";?>
	<?php include _template.$template."_tpl.php";?>
	<?php include _template."layout/footer.php";?>
</div>

<?php //include _template."layout/base_schema.php";?>
</body>
</html>