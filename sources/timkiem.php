<?php  if(!defined('_source')) die("Error");

		@$idc =  addslashes($_GET['idc']);
		@$idi =  addslashes($_GET['idi']);
		@$ide =  addslashes($_GET['ide']);
		@$idm =  addslashes($_GET['hang']);
		@$id=  addslashes($_GET['id']);
		#các sản phẩm khác======================
		
		
		
		
		
		
		$sql = "select id,id_item,thumb,photo,id_cat,giaban,maso_$lang  from #_product where hienthi=1";
		if(!empty($_POST))
		{
		$ten=trim($_POST['timkiem']);
		
		if($ten!='')
		{
		$sql.=" and maso_$lang like'%$ten%'";
		}
		}
		$sql.=" order by stt,ngaytao desc";
		
		$d->query($sql);
		$product = $d->result_array();
		$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
		$url="tim-kiem.html";
		$maxR=28;
		$maxP=4;
		$paging=paging($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];
		
		
		
	
		if($id!='')
		{
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keyword'];
			$description_bar .= $row_detail['description'];
			
		} else {
			$title_bar .= $row_title['ten'];
			$keyword_bar .= $row_meta['ten'];
			$description_bar .= $row_meta['ten'];
		} 
		
			
?>