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

		
	@$id = (string)$_POST['id_city'];

	$d->reset();
	$sql="select id,ten from #_place_city where ten='".$id."'";
	$d->query($sql);
	$tinh = $d->fetch_array();

	$d->reset();
	$sql="select ten from #_place_dist where id_city='".$tinh['id']."'  and  hienthi=1 order by id asc";
	$d->query($sql);
	$quan = $d->result_array();

	
?>

<ul class="w-level-list">
	<li class="curren-city">
		<svg class="mych-svg-icon icon-arrow-left" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0"><g><path d="m8.5 11c-.1 0-.2 0-.3-.1l-6-5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4l6-5c .2-.2.5-.1.7.1s.1.5-.1.7l-5.5 4.6 5.5 4.6c.2.2.2.5.1.7-.1.1-.3.2-.4.2z"></path></g></svg>
		<?=$tinh['ten']?>
	</li>
	<?php foreach ($quan as $key => $value) {?>
        <li class="item-level-cat" data-dist="<?=$value['ten']?>" data-city="<?=$tinh['ten']?>"><?=$value['ten']?></li>
	<?php } ?>
</ul>