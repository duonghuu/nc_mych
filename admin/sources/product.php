<?php	if(!defined('_source')) die("Error");
switch($act){
	
	
	case "man_photo":
		get_photos();
		$template = "product/photo/photos";
		break;
	case "add_photo":		
		$template = "product/photo/photo_add";
		break;
	case "edit_photo":		
		get_photo();
		$template = "product/photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;	
	

	case "man_list":
		get_lists();
		$template = "product/list/items";
		break;
	case "add_list":		
		$template = "product/list/item_add";
		break;
	case "edit_list":		
		get_list();
		$template = "product/list/item_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;	
	#===================================================
	case "man_cat":
		get_cats();
		$template = "product/cat/items";
		break;
	case "add_cat":		
		$template = "product/cat/item_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "product/cat/item_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;	
	#===================================================
	case "man_item":
		get_items();
		$template = "product/item/items";
		break;
	case "add_item":		
		$template = "product/item/item_add";
		break;
	case "edit_item":		
		get_item();
		$template = "product/item/item_add";
		break;
	case "save_item":
		save_item();
		break;
	case "delete_item":
		delete_item();
		break;
	#===================================================
	case "man_sub":
		get_subs();
		$template = "product/sub/items";
		break;
	case "add_sub":		
		$template = "product/sub/item_add";
		break;
	case "edit_sub":		
		get_sub();
		$template = "product/sub/item_add";
		break;
	case "save_sub":
		save_sub();
		break;
	case "delete_sub":
		delete_sub();
		break;	
	#===================================================
	case "man":
		get_mans();
		$template = "product/man/items";
		break;
	case "chonthoigian":
		get_chonthoigians();
		$template = "product/man/chonthoigians";
		break;
	case "man2":
		get_man2s();
		$template = "product/man/items";
		break;
	case "add":		
		$template = "product/man/item_add";
		break;
	case "edit":		
		get_man();
		$template = "product/man/item_add";
		break;
	case "save":
		save_man();
		break;
		
	case "delete":
		delete_man();
		break;	
	#============================================================
	case "duyetbl":
		get_duyetbl();
		$template = "product/duyetbl";
		break;
	case "delete_binhluan":
		delete_binhluan();
		$template = "product/duyetbl";
		break;
	default:
		$template = "index";
}




#====================================

function get_mans(){
	global $d, $items, $paging,$page,$id_daily;
	#----------------------------------------------------------------------------------------
	if($_REQUEST['ggsp']!='')
	{
	$id_up = $_REQUEST['ggsp'];
	$sql_sp = "SELECT id,ggsp FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['ggsp'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET ggsp =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET ggsp =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#----------------------------------------------------------------------------------------
	if($_REQUEST['banchay']!='')
	{
	$id_up = $_REQUEST['banchay'];
	$sql_sp = "SELECT id,banchay FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['banchay'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#----------------------------------------------------------------------------------------
	if($_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['noibat'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat = ".$_GET['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item = ".$_GET['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_sub']!='')
	{
		$where.=" and id_sub = ".$_GET['id_sub'];
		$link_add .= "&id_sub=".$_GET['id_sub'];
	}
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,noibat,id_item,id_sub,banchay,ggsp,thumb from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=product&act=man&type=".$_GET['type']."".$link_add."&type=".$_GET['type'];
	$paging = pagination($where,$per_page,$page,$url);		
	
	// $sql_soluong = "UPDATE #_product SET soluongton=100  WHERE type ='product'";
	// $d->query($sql_soluong);

	if($_GET['type']=='deal-gia-soc'){
		if($_POST['checktime']=='timedeal'){
			$data['thoigiantu'] = $_POST['thoigiantu'];
			$data['thoigianden'] = $_POST['thoigianden'];
			$d->reset();
			$d->setTable('setting');
			if($d->update($data)){
				transfer("Cập nhật dữ liệu thành công", $_SESSION['links_re']);
			}else{
				transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
			}
		}
	}
}

function get_chonthoigians(){
	global $d, $items, $paging,$page,$id_daily;
	#----------------------------------------------------------------------------------------
	if($_REQUEST['ggsp']!='')
	{
	$id_up = $_REQUEST['ggsp'];
	$sql_sp = "SELECT id,ggsp FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['ggsp'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET ggsp =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET ggsp =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#----------------------------------------------------------------------------------------
	if($_REQUEST['banchay']!='')
	{
	$id_up = $_REQUEST['banchay'];
	$sql_sp = "SELECT id,banchay FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['banchay'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#----------------------------------------------------------------------------------------
	if($_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['noibat'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat = ".$_GET['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item = ".$_GET['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_sub']!='')
	{
		$where.=" and id_sub = ".$_GET['id_sub'];
		$link_add .= "&id_sub=".$_GET['id_sub'];
	}
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_tggiao']!='')
	{
		$link_add .= "&id_tggiao=".$_GET['id_tggiao'];
	}
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,noibat,id_item,id_sub,banchay,ggsp,thumb,id_tggiao from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=product&act=".$_GET['act']."&type=".$_GET['type'].$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
	
	// $sql_soluong = "UPDATE #_product SET soluongton=100  WHERE type ='product'";
	// $d->query($sql_soluong);

	if($_GET['type']=='deal-gia-soc'){
		if($_POST['checktime']=='timedeal'){
			$data['thoigiantu'] = $_POST['thoigiantu'];
			$data['thoigianden'] = $_POST['thoigianden'];
			$d->reset();
			$d->setTable('setting');
			if($d->update($data)){
				transfer("Cập nhật dữ liệu thành công", $_SESSION['links_re']);
			}else{
				transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
			}
		}
	}
}
function get_man2s(){
	global $d, $items, $paging,$page,$id_daily;
	#----------------------------------------------------------------------------------------
	if($_REQUEST['ggsp']!='')
	{
	$id_up = $_REQUEST['ggsp'];
	$sql_sp = "SELECT id,ggsp FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['ggsp'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET ggsp =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET ggsp =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#----------------------------------------------------------------------------------------
	if($_REQUEST['banchay']!='')
	{
	$id_up = $_REQUEST['banchay'];
	$sql_sp = "SELECT id,banchay FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['banchay'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET banchay =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#----------------------------------------------------------------------------------------
	if($_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['noibat'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_product where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_product SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product ";
	$where .= " where type='".$_GET['type']."' ";
	$where .= " and ggsp>0 and banchay>0 ";

	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat = ".$_GET['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item = ".$_GET['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_sub']!='')
	{
		$where.=" and id_sub = ".$_GET['id_sub'];
		$link_add .= "&id_sub=".$_GET['id_sub'];
	}
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,noibat,id_item,id_sub,banchay,ggsp,thumb from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
	$url = "index.php?com=product&act=man2&type=".$_GET['type']."".$link_add."&type=".$_GET['type'];
	$paging = pagination($where,$per_page,$page,$url);		
	
	// $sql_soluong = "UPDATE #_product SET soluongton=100  WHERE type ='product'";
	// $d->query($sql_soluong);

	if($_GET['type']=='deal-gia-soc'){
		if($_POST['checktime']=='timedeal'){
			$data['thoigiantu'] = $_POST['thoigiantu'];
			$data['thoigianden'] = $_POST['thoigianden'];
			$d->reset();
			$d->setTable('setting');
			if($d->update($data)){
				transfer("Cập nhật dữ liệu thành công", $_SESSION['links_re']);
			}else{
				transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
			}
		}
	}
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo,$add_data;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$_GET['type']);	
	$sql = "select * from #_product where id='".$id."'";
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$sql.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	

	$sql = "select * from #_product_photo where id_product='".$id."' and type='".$_GET['type']."' order by stt,id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
	if(!empty($item)){
		$d->reset();
		$d->setTable("baiviet");
		$d->setWhere("id_item",$id);
		$d->setWhere("type",$_GET["type"]);
		$d->select("id,ten_vi,photo");
		$add_data = $d->result_array();
	}

			
}

function save_man(){
	global $d,$id_daily;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){

		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);	
				delete_file(_upload_product.$row['thumb']);				
			}
		}

	    $data['id_list'] = (int)$_POST['id_list'];	
	    $data['id_tggiao'] = (int)$_POST['id_tggiao'];	
		
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];
		
		$data['id_daily'] = (int)$id_daily;	

		$data['ten_vi'] = $_POST['ten_vi'];
		
		$data['Weight'] = $_POST['Weight'];
		
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['mota_vi'] = magic_quote($_POST['mota_vi']);
		$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);
		$data['baohanh_vi'] = magic_quote($_POST['baohanh_vi']);	
		$data['baohanh_en'] = magic_quote($_POST['baohanh_en']);	
		$data['thongtin_vi'] = magic_quote($_POST['thongtin_vi']);
		$data['thongtin_en'] = magic_quote($_POST['thongtin_en']);

		$data['thuoctinh'] = $_POST['thuoctinh'];

		$data['thongtinthem_vi'] = magic_quote($_POST['thongtinthem_vi']);
		$data['thongsokythuat'] = magic_quote($_POST['thongsokythuat']);

		$data['ten_en'] = $_POST['ten_en'];
		$data['luotxem2'] = $_POST['luotxem2'];

		$data['mota_en'] = magic_quote($_POST['mota_en']);
		$data['noidung_en'] = magic_quote($_POST['noidung_en']);	
		
		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['trongluong'] = str_replace(',','',$_POST['trongluong']);
		$data['dungtich'] = str_replace(',','',$_POST['dungtich']);
		$data['masp'] = $_POST['masp'];
		if($_POST['khuyenmai_vi']){
			$data['khuyenmai_vi'] = implode('|',$_POST['khuyenmai_vi']);
		}

		if($_POST['tags']){
			$data['tags'] = implode(',',$_POST['tags']);
		}

		$countsl = $_POST['gia'];
		$min=$countsl[0];
		$myFile_size = $_FILES['fileupsize'];
		$upsize_name=fns_Rand_digit(0,3,5);
		if(count($countsl) > 0){
			for($k=0;$k<count($countsl);$k++){
				if($min > $countsl[$k]){
					$min = $countsl[$k]	;
				}
				if($countsl[$k] != NULL){
					$data['size'] =  implode('|',$_POST['size']); 
					$data['gia'] = implode('|',$_POST['gia']);
					if($myFile_size['name'][$k]!="")
					{
						if(move_uploaded_file($myFile_size["tmp_name"][$k], _upload_baiviet."/".$upsize_name."_".str_replace(' ','',$myFile_size["name"][$k])))
						{		 
							if($_POST["fileupsizename"][$k]!=""){
								delete_file(_upload_baiviet.$_POST["fileupsizename"][$k]);
							}
							$_POST["fileupsizename"][$k] = $upsize_name."_".str_replace(' ','',$myFile_size["name"][$k]);
						}
					}
					$data['hinhsize'] = implode('|',$_POST['fileupsizename']);
				}
			}
		}else{
			$data['size'] = "";
			$data['gia'] = "";
		}

		if($_POST['mausac']){
			$data['mausac'] =  implode('|',$_POST['mausac']); 
		}else{
			$data['mausac'] = "";
		}

		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$data['stt'] = $_POST['stt'];
		$data['soluongdeal'] = $_POST['soluongdeal'];
		$data['soluongban'] = $_POST['soluongban'];
		$data['soluongton'] = $_POST['soluongton'];
		$data['id_user'] = $_POST['id_user'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaysua'] = time();
		$d->setTable('product');
		$d->setWhere('id', $id);
		if($d->update($data)){
			// $sql = "delete from #_mausp where id_product='".$id."'";
   //          $d->query($sql);
			// if($_POST['team_bangsize']) {
   //  			$idTeam = $_POST['team_bangsize'];
   //  			for($i=0;$i<count($idTeam);$i++) {
   //  				$team_bangsize['id_product'] = $id;
   //  				$team_bangsize['id_color'] = $idTeam[$i];
   //  				$d->setTable('mausp');
   //  				$d->insert($team_bangsize);
   //  			}
			// }

			if (isset($_FILES['files'])) {
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
					    $file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_product'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('product_photo');
						$d->insert($data1);

					}
				}
	        }
	        $idgoiArr = $_POST['idgoi'];
	        $tengoiArr = $_POST['tengoi'];
	        $myFile_mau = $_FILES['fileuptaptin'];
	        $uptaptin_name=fns_Rand_digit(0,3,5);
	        if(!empty($idgoiArr)){
	        	for($i = 0; $i < count($idgoiArr); $i++){
	        		if(!empty($idgoiArr[$i])){
	        			$i_ten = $tengoiArr[$i];
	        			$i_data = array();
	        			if(move_uploaded_file($myFile_mau["tmp_name"][$i], _upload_baiviet."/".$uptaptin_name."_".str_replace(' ','',$myFile_mau["name"][$i])))
	        			{
	        				$d->reset();
	        				$sql = "select photo from table_baiviet where id='".$vud."' ";
	        				$d->query($sql);
	        				$row = $d->fetch_array();	
	        				if($row['photo']!=""){
	        					delete_file(_upload_baiviet.$row['photo']);
	        				}
	        				$sql="UPDATE table_baiviet set photo='".$uptaptin_name."_".str_replace(' ','',$myFile_mau["name"][$i])."' 
	        				where id='".$vud."' ";
	        				mysql_query($sql);
	        			}
	        			$d->reset();
	        			$d->setTable("baiviet");
	        			
	        			$i_data["id_item"] = $id;
	        			$i_data["ten_vi"] = $i_ten;
	        			$i_data["tenkhongdau"] = changeTitle($i_ten);			
	        			$i_data["ngaysua"] = time();
	        			$d->setWhere("id",$idgoiArr[$i]);
	        			$d->update($i_data);
	                        //database update query goes here
	        		}else{
	        			$i_ten = $tengoiArr[$i];
	        			if(!empty($i_ten)){
	        				$i_data = array();
	        				$uptaptin_name=fns_Rand_digit(0,3,5);
	        				if(move_uploaded_file($myFile_mau["tmp_name"][$i], _upload_baiviet."/".$uptaptin_name."_".str_replace(' ','',$myFile_mau["name"][$i])))
	        				{	
	        					$i_data['photo'] = $uptaptin_name."_".str_replace(' ','',$myFile_mau["name"][$i]);	
	        					//dump($data2['photo']);
	        				}
	        				$d->reset();
	        				$d->setTable("baiviet");
	        				
	        				$i_data["id_item"] = $id;
	        				$i_data["type"] = $_GET["type"];
	        				$i_data["ten_vi"] = $i_ten;
	        				$i_data["tenkhongdau"] = changeTitle($i_ten);			
	        				$i_data["ngaytao"] = time();
	        				$d->insert($i_data);
	        				//database insert query goes here
	        			}
	        		}
	        	}
	        }
			redirect("index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
		}		
		
	    $data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];
		$data['id_tggiao'] = (int)$_POST['id_tggiao'];	
		$data['id_daily'] = (int)$id_daily;	

		$data['ten_vi'] = $_POST['ten_vi'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['mota_vi'] = magic_quote($_POST['mota_vi']);
		$data['noidung_vi'] = magic_quote($_POST['noidung_vi']);	
		$data['baohanh_vi'] = magic_quote($_POST['baohanh_vi']);	
		$data['baohanh_en'] = magic_quote($_POST['baohanh_en']);	
		$data['thongtin_vi'] = magic_quote($_POST['thongtin_vi']);	
		$data['thongtin_en'] = magic_quote($_POST['thongtin_en']);
		
		$data['Weight'] = $_POST['Weight'];
		$data['luotxem2'] = $_POST['luotxem2'];
		$data['thuoctinh'] = $_POST['thuoctinh'];

		$data['thongtinthem_vi'] = magic_quote($_POST['thongtinthem_vi']);
		$data['thongsokythuat'] = magic_quote($_POST['thongsokythuat']);

		$data['ten_en'] = $_POST['ten_en'];
		$data['mota_en'] = $_POST['mota_en'];
		$data['noidung_en'] = magic_quote($_POST['noidung_en']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		
		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['trongluong'] = str_replace(',','',$_POST['trongluong']);
		$data['dungtich'] = str_replace(',','',$_POST['dungtich']);
		$data['masp'] = $_POST['masp'];
		$data['id_user'] = $_POST['id_user'];
		if($_POST['khuyenmai_vi']){
			$data['khuyenmai_vi'] = implode('|',$_POST['khuyenmai_vi']);
		}

		if($_POST['tags']){
			$data['tags'] = implode(',',$_POST['tags']);
		}

		$countsl = $_POST['gia'];
		$min=$countsl[0];
		$myFile_size = $_FILES['fileupsize'];
		$upsize_name=fns_Rand_digit(0,3,5);
		for($k=0;$k<count($countsl);$k++){
			if($min > $countsl[$k]){
				$min = $countsl[$k]	;
			}
			if($countsl[$k] != NULL){
				$data['size'] =  implode('|',$_POST['size']); 
				$data['gia'] = implode('|',$_POST['gia']);
				if($myFile_size['name'][$k]!="")
				{
				    if(move_uploaded_file($myFile_size["tmp_name"][$k], _upload_baiviet."/".$upsize_name."_".str_replace(' ','',$myFile_size["name"][$k])))
				    {        
				        if($_POST["fileupsizename"][$k]!=""){
				            delete_file(_upload_baiviet.$_POST["fileupsizename"][$k]);
				        }
				        $_POST["fileupsizename"][$k] = $upsize_name."_".str_replace(' ','',$myFile_size["name"][$k]);
				    }
				}
				$data['hinhsize'] = implode('|',$_POST['fileupsizename']);
			}
		}

		
		if($_POST['mausac']){
			$data['mausac'] =  implode('|',$_POST['mausac']); 
		}else{
			$data['mausac'] = "";
		}

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		
		$data['stt'] = $_POST['stt'];
		$data['soluongdeal'] = $_POST['soluongdeal'];
		$data['soluongban'] = $_POST['soluongban'];
		$data['soluongton'] = $_POST['soluongton'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product');
		if($d->insert($data))
		{	

			$id = mysql_insert_id();

			// if($_POST['team_bangsize']) {	
   //  			$idTeam = $_POST['team_bangsize'];
   //  			for($i=0;$i<count($idTeam);$i++) {
   //  				$team_bangsize['id_product'] = $id;
   //  				$team_bangsize['id_color'] = $idTeam[$i];
   //  				$d->setTable('mausp');
   //  				$d->insert($team_bangsize);
   //  			}
			// }

			if (isset($_FILES['files'])) {
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
					    $file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_product'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('product_photo');
						$d->insert($data1);

					}
				}
	        }
	        $idgoiArr = $_POST['idgoi'];
	        $tengoiArr = $_POST['tengoi'];
	        $myFile_mau = $_FILES['fileuptaptin'];
	        if(!empty($idgoiArr)){
	        	for($i = 0; $i < count($idgoiArr); $i++){
	        		$i_ten = $tengoiArr[$i];
	        		$d->reset();
	        		$d->setTable("baiviet");
	        		$i_data = array();
	        		$uptaptin_name=fns_Rand_digit(0,3,5);
	        		if(move_uploaded_file($myFile_mau["tmp_name"][$i], _upload_baiviet."/".$uptaptin_name."_".str_replace(' ','',$myFile_mau["name"][$i])))
	        		{	
	        			$i_data['photo'] = $uptaptin_name."_".str_replace(' ','',$myFile_mau["name"][$i]);	
	        			//dump($data2['photo']);
	        		}
	        		$i_data["id_item"] = $id;
	        		$i_data["type"] = $_GET["type"];
	        		$i_data["ten_vi"] = $i_ten;
	        		$i_data["tenkhongdau"] = changeTitle($i_ten);			
	        		$i_data["ngaytao"] = time();
	        		$d->insert($i_data);
	        		//database insert query goes here
	        	}
	        }
			redirect("index.php?com=product&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$_GET['type']);
	}
}

function delete_man(){
	global $d;
	

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);

		$d->reset();
		$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_product.$photo_lq[$i]['photo']);
				delete_file(_upload_product.$photo_lq[$i]['thumb']);
			}
		}
		$sql = "delete from #_product_photo where id_product='".$id."'";
		$d->query($sql);

		$d->reset();
		$sql = "select id,photo from #_baiviet where id_item='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_baiviet.$photo_lq[$i]['photo']);
			}
		}
		$sql = "delete from #_baiviet where id_item='".$id."'";
		$d->query($sql);




		$d->reset();
		$sql = "select id,photo,thumb,hinhsize from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$hinhsizesp = explode('|',$row['hinhsize']);
			for($j=0;$j<count($hinhsizesp);$j++){
				delete_file(_upload_baiviet.$hinhsizesp[$j]);
			}	
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	

			$d->reset();
			$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
			$d->query($sql);
			$photo_lq = $d->result_array();
			if(count($photo_lq)>0){
				for($j=0;$j<count($photo_lq);$j++){
					delete_file(_upload_product.$photo_lq[$j]['photo']);
					delete_file(_upload_product.$photo_lq[$j]['thumb']);
				}
			}
			$sql = "delete from #_product_photo where id_product='".$id."'";
			$d->query($sql);


			$d->reset();
			$sql = "select id,photo from #_baiviet where id_item='".$id."'";
			$d->query($sql);
			$photo_lq = $d->result_array();
			if(count($photo_lq)>0){
				for($i=0;$i<count($photo_lq);$i++){
					delete_file(_upload_baiviet.$photo_lq[$i]['photo']);
				}
			}
			$sql = "delete from #_baiviet where id_item='".$id."'";
			$d->query($sql);
			

			$d->reset();
			$sql = "select id,photo,thumb,hinhsize from #_product where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				$hinhsizesp = explode('|',$row['hinhsize']);
				for($j=0;$j<count($hinhsizesp);$j++){
					delete_file(_upload_baiviet.$hinhsizesp[$j]);
				}	
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}


}


#=================List===================

function get_lists(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_list where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_list SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_list SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_product_list ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	$where .=" order by stt,id desc";

	$sql = "select ten_vi,id,stt,hienthi,noibat,danhmuc from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

    $url = "index.php?com=product&act=man_list&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_list(){
	global $d, $item,$ds_photo;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$_GET['type']);
	
	$sql = "select * from #_product_list where id='".$id."'";
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$sql.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_list&type=".$_GET['type']);
	$item = $d->fetch_array();

	$d->reset();
	$sql = "select * from #_product_photo where id_product='".$id."' and type='product_list' order by stt,id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
	//print_r($ds_photo)


}

function save_list(){
	global $d,$id_daily;
	
	$file_name=images_name($_FILES['file']['name']);
	$file_name2=images_name($_FILES['file2']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 60, 60, _upload_product,$file_name,2);	
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
		}

		if($file_name2 = upload_image("file2", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name2)){
			$data['photo2'] = $file_name2;
			$data['thumb2'] = create_thumb($data['photo2'], 170, 160, _upload_product,$file_name2,2);	
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo2']);
				delete_file(_upload_product.$row['thumb2']);
			}
		}


		// if($quangcaotrai = upload_image("file1", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
		// 	$data['quangcaotrai'] = $quangcaotrai;
		// 	$data['quangcaotraithumb'] = create_thumb($data['quangcaotrai'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
		// 	$d->setTable('product_list');
		// 	$d->setWhere('id', $id);
		// 	$d->select();
		// 	if($d->num_rows()>0){
		// 		$row = $d->fetch_array();
		// 		delete_file(_upload_product.$row['quangcaotrai']);
		// 	}
		// }		

		// if($quangcaophai = upload_image("file2", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
		// 	$data['quangcaophai'] = $quangcaophai;
		// 	$data['quangcaophaithumb'] = create_thumb($data['quangcaophai'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
		// 	$d->setTable('product_list');
		// 	$d->setWhere('id', $id);
		// 	$d->select();
		// 	if($d->num_rows()>0){
		// 		$row = $d->fetch_array();
		// 		delete_file(_upload_product.$row['quangcaophai']);
		// 	}
		// }

		// if($icon = upload_image("icon", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
		// 	$data['icon'] = $icon;			
		// 	$d->setTable('product_list');
		// 	$d->setWhere('id', $id);
		// 	$d->select();
		// }

		$data['id_daily'] = $id_daily;
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['name_en'] = $_POST['name_en'];
		$data['name_vi'] = $_POST['name_vi'];
		$data['links'] = $_POST['links'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['linkqctrai'] = $_POST['linkqctrai'];
		$data['linkqcphai'] = $_POST['linkqcphai'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();

	//dump($_FILES['files']);

		if (isset($_FILES['files'])) {
    for($i=0;$i<count($_FILES['files']['name']);$i++){
    	if($_FILES['files']['name'][$i]!=''){

			$file['name'] = $_FILES['files']['name'][$i];
			$file['type'] = $_FILES['files']['type'][$i];
			$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			$file['error'] = $_FILES['files']['error'][$i];
			$file['size'] = $_FILES['files']['size'][$i];
		    $file_name = images_name($_FILES['files']['name'][$i]);
			$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
			$data1['photo'] = $photo;
			$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
			$data1['stt'] = (int)$_POST['stthinh'][$i];
			$data1['type'] ='product_list';	
			$data1['id_product'] = $id;
			$data1['hienthi'] = 1;
			$d->setTable('product_photo');
			$d->insert($data1);

				}
			}
		}

		
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", _img_type, _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 60, 60, _upload_product,$file_name,_style_thumb);	
		}

		if($icon = upload_image("icon", _img_type, _upload_product,$file_name)){
			$data['icon'] = $icon;			
		}

		$data['id_daily'] = $id_daily;
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['name_en'] = $_POST['name_en'];
		$data['name_vi'] = $_POST['name_vi'];
		$data['links'] = $_POST['links'];
		$data['linkqctrai'] = $_POST['linkqctrai'];
		$data['linkqcphai'] = $_POST['linkqcphai'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type'] = $_GET['type'];
		
		$d->setTable('product_list');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_list&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$_GET['type']);
	}
}

function delete_list(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb,quangcaotrai,quangcaotrai,quangcaotraithumb,quangcaophai,quangcaophaithumb from #_product_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_list where id='".$id."'";
			$d->query($sql);

			$d->reset();
			$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."' and type ='product_list' ";
			$d->query($sql);
			$photo_lq2 = $d->result_array();
			if(count($photo_lq)>0){
				for($i=0;$i<count($photo_lq);$i++){
					delete_file(_upload_product.$photo_lq2[$i]['photo']);
					delete_file(_upload_product.$photo_lq2[$i]['thumb']);
				}
			}
			$sql = "delete from #_product_photo where id_product='".$id."'";
			$d->query($sql);


		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}

#=================cat===================

function get_cats(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_cat where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_cat SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=product&act=man_cat&type=".$_GET['type'];
	
	$where = " #_product_cat ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}

	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=product&act=man_cat&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_cat(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	
	$sql = "select * from #_product_cat where id='".$id."'";
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$sql.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$id_daily;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 60, 60, _upload_product,$file_name,_style_thumb);
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_daily'] = $id_daily;
		
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 60, 60, _upload_product,$file_name,_style_thumb);
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_daily'] = $id_daily;
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_cat');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_cat&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	}
}

function delete_cat(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_cat where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}
#=================Item===================

function get_items(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_item SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_item SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=product&act=man_item&type=".$_GET['type'];
	
	$where = " #_product_item ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$where.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}

	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,noibat from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=product&act=man_item&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
	
}

function get_item(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$_GET['type']);
	
	$sql = "select * from #_product_item where id='".$id."'";
	if($_SESSION['login_admin']['type']=='daily' && !empty($_SESSION['login_admin']['id_daily'])){
		$sql.= " and id_daily=".$_SESSION['login_admin']['id_daily'];
	}
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_item&type=".$_GET['type']);
	$item = $d->fetch_array();

}

function save_item(){
	global $d,$id_daily;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		$sql = "select tenkhongdau,id from #_product_item where type='".$_GET['type']."'";
		$d->query($sql);
		$cat = $d->result_array();
		$flag=0;

		for($i=0;$i<count($cat);$i++){
			if(changeTitle($_POST['ten_vi'])==$cat[$i]['tenkhongdau'])
				$flag=1;
		}

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 170, 160, _upload_product,$file_name,_style_thumb);
			$d->setTable('product_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}
		
		$data['id_daily'] = $id_daily;
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_item'] = $_POST['id_item'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		

		$so = rand(0,10000);

		if($flag==1)
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']).'-'.$so;
		else
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$_GET['type']);
	}else{

		$sql = "select tenkhongdau,id from #_product_item where type='".$_GET['type']."'";
		$d->query($sql);
		$cat = $d->result_array();
		$flag=0;
		for($i=0;$i<count($cat);$i++){
			if(changeTitle($_POST['ten_vi'])==$cat[$i]['tenkhongdau'])
				$flag=1;
		}

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 170, 160, _upload_product,$file_name,_style_thumb);
		}
		$data['id_daily'] = $id_daily;
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
			$data['id_item'] = $_POST['id_item'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		
		if($flag==1)
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']).'-'.time();
		else
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_item');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_item&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_item where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_item where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_item where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}
#=================Sub===================

function get_subs(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_sub where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_sub SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_sub SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=product&act=man_sub&type=".$_GET['type'];
	
	$where = " #_product_sub ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item=".$_REQUEST['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,id_item from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=product&act=man_sub&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_sub(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_sub&type=".$_GET['type']);
	
	$sql = "select * from #_product_sub where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_sub&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_sub(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_sub&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product_sub');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);	
				delete_file(_upload_product.$row['thumb']);				
			}
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_item'] = $_POST['id_item'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_sub');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_sub&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_sub&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_item'] = $_POST['id_item'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_sub');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_sub&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_sub&type=".$_GET['type']);
	}
}

function delete_sub(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_sub where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_sub where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_sub&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_sub&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_sub where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_sub where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_sub&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_sub&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}
#====================================



#=================List===================

function get_photos(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_photo where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_photo SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_photo SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_product_photo ";
	$where .= " where id_product='".$_REQUEST['idc']."' and type='".$_REQUEST['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_REQUEST['keyword'];
	}
	$where .=" order by stt,id desc";

	$sql = "select ten_vi,id,stt,hienthi,photo,id_product,type from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

    $url = "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."".$link_add."&type=".$_REQUEST['type'];
	$paging = pagination($where,$per_page,$page,$url);
}

function get_photo(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&idc=".$_GET['idc']."&type=".$_REQUEST['type']);
	
	$sql = "select * from #_product_photo where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_list&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
	$item = $d->fetch_array();

}

function save_photo(){
	global $d;
	
	$file_name=fns_Rand_digit(0,9,10);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product_photo');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}



		$data['ten_vi'] = $_POST['ten_vi'];
		$data['type'] = $_REQUEST['type'];
		$data['links'] = $_POST['links'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();


		
		$d->setTable('product_photo');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_photo&curPage=".$_REQUEST['curPage']."&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
	}else{
		
		
		
		for($i=0; $i<5; $i++){
				if($data['photo'] = upload_image("file".$i, 'jpg|png|gif|GIF|PNG|JPG|jpeg|JPEG|pdf|doc|docx|rar|zip|PDF|DOC|DOCX|RAR|ZIP', _upload_product,$file_name.$i))
					{
					
						$data['stt'] = $_POST['stt'.$i];
						$data['links'] = $_POST['links'.$i];
						$data['ten_vi'] = $_POST['ten_vi'.$i];
						
						$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
						$data['type'] = $_REQUEST['type'];
						$data['id_product'] = $_REQUEST['idc'];
						$d->setTable('product_photo');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&type=$_REQUEST[type]&idc=$_REQUEST[idc]&act=man_photo");
					}
			}
			redirect("index.php?com=product&type=$_REQUEST[type]&act=man_photo&idc=".$_REQUEST['idc']."");

		

	}
}

function delete_photo(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_photo where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_photo where id='".$id."'";
			$d->query($sql);


		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_photo&curPage=".$_REQUEST['curPage']."&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_photo&curPage=".$_REQUEST['curPage']."&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_photo where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_photo where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_photo&curPage=".$_REQUEST['curPage']."&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_photo&curPage=".$_REQUEST['curPage']."&idc=".$_REQUEST['idc']."&type=".$_REQUEST['type']);
	}
}



?>