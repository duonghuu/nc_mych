<?php 
	session_start();
	/* @define ( '_template' , './templates/'); */
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	include_once _lib."Mobile_Detect.php";
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	if($deviceType != 'computer'){
		@define ( '_template' , './m/');
		
	}else{
		@define ( '_template' , './templates/');
	}
	
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
	//include_once "smsapi.php";
	#======================addtocar
	if(!empty($_GET) && $_GET["id_product"]!='' && $_GET["soluong"]!='' ){
		include_once _lib."functions_giohang.php"; 	
		if(addtocart(intval($_GET["id_product"]),intval($_GET["soluong"]),intval(@$_GET["color"]),intval(@$_GET["size"]))){
			if($_GET["add-to-pay"]!=''){
				redirect("http://".$config_url."/thanh-toan.html");
			}else if($_GET["add-to-cart"]!=''){
				redirect("http://".$config_url."/gio-hang.html");
			}
		}	
	}
?>