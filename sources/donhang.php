<?php  if(!defined('_source')) die("Error");

	$d->reset();
	$sql_user = "select * from #_member where id='".$_SESSION['login']['id_tv']."'";
	$d->query($sql_user);
	$row_thanhvien = $d->fetch_array();

	$d->reset();
	$sql_detail = "select * from #_order where email='".$_SESSION['login']['email']."'";
	$d->query($sql_detail);
	$row_order = $d->result_array();

	$d->reset();
	$sql_detail = "select * from #_order where email='".$_SESSION['login']['email']."' and trangthai='1'";
	$d->query($sql_detail);
	$row_chothanhtoan = $d->result_array();

	$d->reset();
	$sql_detail = "select * from #_order where email='".$_SESSION['login']['email']."' and trangthai='2'";
	$d->query($sql_detail);
	$row_cholayhang = $d->result_array();

	$d->reset();
	$sql_detail = "select * from #_order where email='".$_SESSION['login']['email']."' and trangthai='3'";
	$d->query($sql_detail);
	$row_danggiao = $d->result_array();


	$d->reset();
	$sql_detail = "select * from #_order where email='".$_SESSION['login']['email']."' and trangthai='4'";
	$d->query($sql_detail);
	$row_dagiao = $d->result_array();

	$d->reset();
	$sql_detail = "select * from #_order where email='".$_SESSION['login']['email']."' and trangthai='5'";
	$d->query($sql_detail);
	$row_dahuy = $d->result_array();

			
?>