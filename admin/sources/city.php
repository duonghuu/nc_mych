<?php	

if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";

$duongdan=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];
switch($act){


	#===================================================	
	case "man_cat":
		get_cats();
		$template = "city/cats";
		break;
	case "add_cat":		
		$template = "city/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "city/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "city/lists";
		break;
	case "add_list":		
		$template = "city/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "city/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
		
		
	
	default:
		$template = "index";
}


#=================CAP 1===================
function get_lists(){
	global $d, $items, $paging,$duongdan ,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_list SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_list");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_city_list SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_list");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_list where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
			
				$sql = "delete from table_city_list where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_list");			
		}
		
		
	}
	
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_list where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_list SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_list SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	redirect($duongdan);
	}
	
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
	
	$sql="SELECT count(id) AS numrows FROM #_city_list where id  $where ";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_city_list where  id $where order by stt,id asc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();		
	$url_link="index.php?com=city&act=man_list";
}

function get_list(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);	
	$sql = "select * from #_city_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();	
}

function save_list(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 210, 170, _upload_city,$file_name,2);		
			$d->setTable('city');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}							
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi","index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 210, 170, _upload_city,$file_name,2);		
		}			
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_list');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi","index.php?com=city&act=man_list&curPage=".$_REQUEST['curPage']."");
	}
}
function delete_list(){
	global $d,$duongdan;

	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_list where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_list where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_list where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}

#=================CAP 2===================
function get_cats(){
	global $d, $items, $paging,$duongdan,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_city_cat SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_cat");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		
				$sql = "UPDATE table_city_cat SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_cat");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_city_cat where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				
				
				$sql = "delete from table_city_cat where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=city&act=man_cat");			
		}
		
		
	}
	
	#----------------------------------------------------------------------------------------

	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_city_cat where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_cat SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_city_cat SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	redirect($duongdan);
	}
	#-------------------------------------------------------------------------------
	
	if((int)@$_REQUEST['id_list']!='')
	{
	$where.=" and id_list=".$_REQUEST['id_list']."";
	}
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
	

	
	$sql="SELECT count(id) AS numrows FROM #_city_cat where id  $where ";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_city_cat where  id $where order by stt,id asc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();		
	$url_link="index.php?com=city&act=man_cat";
}

function get_cat(){
	global $d, $item,$duongdan;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);
	
	$sql = "select * from #_city_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$duongdan;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|GIF|PNG', _upload_city,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 175,175, _upload_city,$file_name,2);		
			$d->setTable('city_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_city.$row['photo']);	
				delete_file(_upload_city.$row['thumb']);				
			}
		}			
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);		
		$data['id_list'] = $_POST['id_list'];			
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('city_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=city&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", $duongdan);
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|GIF|PNG', _upload_city,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 175,175, _upload_city,$file_name,2);		
		}	
		$data['id_list'] = $_POST['id_list'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('city_cat');
		if($d->insert($data))
			redirect("index.php?com=city&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=city&act=man_cat&curPage=".$_REQUEST['curPage']."");
	}
}

function delete_cat(){
	global $d,$duongdan;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_city_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);			
			}
		$sql = "delete from #_city_cat where id='".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect($duongdan);
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id, photo,thumb from #_city_cat where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_city.$row['photo']);
				delete_file(_upload_city.$row['thumb']);
			}
			$sql = "delete from #_city_cat where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}


?>