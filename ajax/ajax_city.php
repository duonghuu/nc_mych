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

	
	if(isset($_GET['id_list'])){
		$id_list=$_GET['id_list'];
		//Lay quan huyen tu tinh thanh
		$d->reset();
		$sql_tinh="select id,ten_$lang as ten from #_city_cat where id_list='".$id_list."'and hienthi =1 order by stt asc";
		$d->query($sql_tinh);
		$quanhuyen = $d->result_array();
		echo'<option value="">Chọn quận huyện</option>';
		for($i=0,$count_quan=count($quanhuyen);$i<$count_quan;$i++) { 
             echo'<option value="'.$quanhuyen[$i]['id'].'">'.$quanhuyen[$i]["ten"].'</option>';
		}
	}
	

?>