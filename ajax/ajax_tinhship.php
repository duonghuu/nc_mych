<?php
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];


	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	$d = new database($config['database']);	

	$id_tinh=$_POST['id_tinh'];
	$id_quanhuyen=$_POST['id_quanhuyen'];
	$loai=$_POST['quanhuyen_loai'];
	$nhom=$_POST['tinh_loai'];
	$ptvc=$_POST['ptvc'];




?>
<?=$_SESSION['giaship']=number_format(get_giaship($nhom,$loai,$ptvc),0, ',', '.')?> VNĐ
