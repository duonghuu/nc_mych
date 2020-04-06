<?php  if(!defined('_source')) die("Error");

	$id =  addslashes($_GET['id']);

	if(isset($_GET['id'])){
		$d->reset();
		$sql = "select noidung_$lang,title,keywords,description,ten_$lang from #_baiviet where type='gioithieu' and tenkhongdau='".$id."' order by stt asc limit 0,1";
		$d->query($sql);
		$row_detail = $d->fetch_array();

		$title_row = $row_detail['ten_'.$lang];

		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];
	}else {

		// cac tin tuc
		$per_page = 1; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_baiviet where hienthi=1 and type='gioithieu' order by stt asc";

		$sql = "select ten_$lang,tenkhongdau,mota_$lang,noidung_$lang from $where $limit";
		$d->query($sql);
		$row_detail = $d->fetch_array();

		$title_row = $row_detail['ten_'.$lang];

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);
	}
	

?>