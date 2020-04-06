<?php  if(!defined('_source')) die("Error");

		$id =  addslashes($_GET['id']);
		
		if($id!=''){

			$sql = "select ten_$lang,mota_$lang,noidung_$lang,ngaytao from #_baiviet where hienthi=1 and id='".$id."'";
			$d->query($sql);
			$tintuc_detail = $d->result_array();

			$title_detail = _dichvu;
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];
			
			#các tin cu hon
			$sql_khac = "select ten_$lang,ngaytao,id,tenkhongdau from #_baiviet where hienthi=1 and id !='".$id."' and type='dichvu' order by stt,ngaytao desc limit 0,10";
			$d->query($sql_khac);
			$tintuc_khac = $d->result_array();

		} else {

			// cac tin tuc
			$per_page = 10; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_baiviet where hienthi=1 and type='dichvu' order by id desc";

			$sql = "select ten_$lang,thumb,tenkhongdau,id,ngaytao,mota_$lang from $where $limit";
			$d->query($sql);
			$tintuc = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title_detail = _dichvu;

		}
	
?>