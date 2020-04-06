<?php if(!defined('_source')) die("Error");
		
		$randomkey = $_GET['capcha'];
		
		//exit();
		$sqlUPDATE_ORDER = "UPDATE table_member SET active=1 WHERE randomkey='$randomkey'";
        $d->reset();
        $sql = "select ten from table_member where randomkey='".$randomkey."'";
        $d->query($sql);
        $taikhoan = $d->fetch_array();
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");

		$title_bar .= _kichhoattaikhoan;	
		$title_tcat = _kichhoattaikhoan;	
?>