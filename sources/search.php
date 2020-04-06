<?php  if(!defined('_source')) die("Error");
$title_detail = _timkiem;
$tukhoakhongdau = changeTitle($_REQUEST['keywords']);
$id_list=trim($_GET['danhmuc']);
$key=trim($_GET['keywords']);
$tukhoa = trim(strip_tags($_REQUEST['keywords']));    	
if (get_magic_quotes_gpc() == false) {
	$tukhoa = addslashes ($tukhoa);
}	
$keywords = explode(' ', $tukhoa);
$searchTermKeywords = array();
foreach ($keywords as $word) 
{
	$searchTermKeywords[] = "ten_$lang LIKE '%$word%'";
}
if ($tukhoa!="")
{
	$where_search.=" and ( ( ".implode(' and ', $searchTermKeywords).") or (ten_vi LIKE '%$tukhoa%') or (tenkhongdau LIKE '%$tukhoakhongdau%')  )";
}
$per_page = 30; 
		// Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page;
$limit = ' limit '.$startpoint.','.$per_page;
$where = " #_product where hienthi=1 $where_search and type='product' ";
$where .= $where_tk;
if($_GET['sort']!=''){
	if($_GET['sort']=='price_DESC'){
		$where .= " order by giaban desc ";
	}else{
		$where .= " order by giaban ";
	}
}else{
	$where .= " order by stt,ngaytao desc ";
}
if($id_list!='')
{
	$where.=" and id_list='".$id_list."' ";
}
$sql = "select * from $where $limit";
		//print_r($sql);
$d->query($sql);
$product = $d->result_array();
$url = getCurrentPageURL();
// $paging = pagination($where,$per_page,$page,$url);
$paging2 = pagination($where,$per_page,$page,$url);
?>