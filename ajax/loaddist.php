<?php
	session_start();
	error_reporting(0);
	@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];
	if($lang=="")
	{
		$lang='vi';
	}

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	$d = new database($config['database']);

		
	@$id = (string)$_POST['id'];

	$d->reset();
	$sql="select id,ten from #_place_city where ten='".$id."'";
	$d->query($sql);
	$tinh = $d->fetch_array();

	$d->reset();
	$sql="select ten from #_place_dist where id_city='".$tinh['id']."'  and  hienthi=1 order by id asc";
	$d->query($sql);
	$quan = $d->result_array();

	$ch = '<option value="0">Chọn quận huyện</option>';
	foreach ($quan as $key => $value) {
		$selected = ($_SESSION['dist']== $value['ten']) ? 'selected="selected"' : '';
		// echo $selected;
		$ch .= '<option value="'.$value['ten'].'" '.$selected.'>'.$value['ten'].'</option>';
	}

	echo $ch;
?>