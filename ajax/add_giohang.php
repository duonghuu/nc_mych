<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	
	@define ( '_lib' , '../libraries/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";;
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
    
	$d = new database($config['database']);
		
	@$pid = $_POST['pid'];
	@$psize= $_POST['psize'];
	@$pgia= $_POST['pgia'];
	@$soluong = $_POST['psluong'];
	@$color = $_POST['color'];


    $result_giohang = addtocart($pid,$soluong,$pgia,$psize,$color);


    $count = count($_SESSION['cart']);

	
	$result = array('result_giohang' => $result_giohang,'count' => $count);

	echo json_encode($result);
?>