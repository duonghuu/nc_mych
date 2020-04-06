<?php if(!defined('_source')) die("Error");
		
		$kichhoat = $_GET['mathanhvien'];
		
		$d->reset();
		$sql = "select * from #_thanhvien where mathanhvien='".$kichhoat."'";
		$d->query($sql);
		$nguoi_gt= $d->fetch_array();
		
		$sqlUPDATE_ORDER = "UPDATE table_thanhvien SET hienthi=1 WHERE mathanhvien='$kichhoat'";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		
		$title_bar .= "Kích hoạt tài khoản .";
	
?>