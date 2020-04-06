<?php
	session_start();
	@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	
	$id=$_POST['id'];
	$rating=$_POST['rate'];

	$d->reset();
	$sql = "select total,rate from #_product where hienthi=1 and type='product' and id=".$id."";
	$d->query($sql);
	$sp = $d->result_array();

	$rating = $rating*2 + $sp[0]['rate'];
	$total =  $sp[0]['total'] + 1;

	$data['rate'] = $rating;
	$data['total'] = $total;
	$d->setTable('product');
	$d->setWhere('id',$id);
	$d->update($data);
	echo 'complete';
 ?>

