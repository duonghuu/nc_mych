<?php

	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	
	@define ( '_lib' , '../libraries/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";;
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
    
	$d = new database($config['database']);

	
	if(isset($_POST['id'])){
		$id=$_POST['id'];
		//Lay quan huyen tu tinh thanh
		$d->reset();
		$sql_cat="select ten_vi,id,tenkhongdau,id_list from #_product_cat where id_list='".$id."' and hienthi =1 order by stt";
		$d->query($sql_cat);
		$row_cat = $d->result_array();
		
	}
	

?>
<?php if($row_cat){$dem=1;?>
	<?php foreach($row_cat as $k =>$v){
		$d->reset();
		$sql_cat="select ten_vi,id,tenkhongdau from #_product_list where id='".$v['id_list']."' and hienthi =1 order by stt";
		$d->query($sql_cat);
		$row_list = $d->fetch_array();
	?>

		<?php if($dem==1){?> <div class="item_cat"> <?php } ?>
			<a href="san-pham/<?=$row_list['tenkhongdau']?>/<?=$v['tenkhongdau']?>"><?=$v['ten_vi']?></a>
		<?php if($dem==4 || $dem==$k){$dem=1;?></div><?php }else{$dem=$dem+1;}?>
	<?php } ?>
<?php } ?>