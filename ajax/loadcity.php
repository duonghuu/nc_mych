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

		
	@$id = (string)$_POST['id'];

	$d->reset();
	$sql="select id,ten from #_place_city";
	$d->query($sql);
	$tinh = $d->result_array();


?>

<ul class="w-level-list">
	<?php foreach ($tinh as $key => $value) {?>
        <li class="item-level-list" data-city="<?=$value['ten']?>"><?=$value['ten']?></li>
	<?php } ?>
</ul>