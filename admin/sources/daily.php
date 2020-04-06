<?php	if(!defined('_source')) die("Error");


$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$duongdan=$_SERVER['HTTP_REFERER'];
$id=@$_REQUEST['id'];

// kiểm tra id đại lý khi đại lý đăng nhập vào
if($_SESSION['login_admin']['type']=='daily'){
	if($_SESSION['login_admin']['id_daily']!=$id){
		transfer("Bạn không có quyền truy cập vào đây","index.php");
	}
}

switch($act){

	
	case "man_list":
		get_lists();
		$template = "daily/lists";
		break;
	case "add_list":		
		$template = "daily/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "daily/list_add";
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

#====================================

#=================CAP 1===================
function get_lists(){
	global $d, $items, $paging,$duongdan ,$url_link,$totalRows , $pageSize, $offset;
	
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['chonxoa'];
		
		//$id_array = explode(",",$_GET['listid']);
		
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_daily SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=daily&act=man_list");			
		}
		
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
		//echo($id_array[$i]);
		//die();
				$sql = "UPDATE table_daily SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=daily&act=man_list");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql="SELECT * FROM table_daily where id='".$id_array[$i]."'";
				$d->query($sql);
				$cats= $d->fetch_array();
				//$id_parent=$cats['id'];
				
				//$sql = "UPDATE table_daily SET id = '".$id_parent."' WHERE  id = ".$id_array[$i]."";
				//mysql_query($sql) or die("Not query sqlUPDATE_ORDER");
				
				$sql = "delete from table_daily where id = ".$id_array[$i]."";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=daily&act=man_list");			
		}
		
		
	}
	
	
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_daily where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$time=time();
		$hienthi=$cats[0]['noibat'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_daily SET noibat = 1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_daily SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
		redirect($duongdan);
	}
	#----------------------------------------------------------------------------------------
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_daily where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_daily SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_daily SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	redirect($duongdan);
	}

	if(@$_REQUEST['moi']!='')
	{
		$id_up = $_REQUEST['moi'];
		$sql_sp = "SELECT id,moi FROM table_daily where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$moi=$cats[0]['moi'];
		if($moi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_daily SET moi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_daily SET moi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}	
	redirect($duongdan);
	}
	
	//$sql = "select * from #_daily";	
	
	
	if(@$_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$where.=" and ten_vi LIKE '%$keyword%' or ten_en LIKE '%$keyword%' ";
	}
		
	
	$sql="SELECT count(id) AS numrows FROM #_daily where id  $where ";
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
	
	$sql = "select * from #_daily where  id $where order by stt,id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();		
	$url_link="index.php?com=daily&act=man_list";
}

function get_list(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);	
	$sql = "select * from #_daily where id='".$id."'";
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
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$d->setTable('daily');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);				
			}
		}			
			
		if(!empty($_POST['madaily'])){
			if(!check_madaily($_POST['madaily']) && $_POST['madaily']!=$_POST['madaily_old']){
				$data['madaily'] = $_POST['madaily'];
			}
			if(check_madaily($_POST['madaily']) && $_POST['madaily']==$_POST['madaily_old']){
				
			}

			if(check_madaily($_POST['madaily']) && $_POST['madaily']!=$_POST['madaily_old']){
				transfer("Mã đại lý này đã tồn tại.<br> Xin vui lòng đổi mã khác.", "index.php?com=daily&act=man_list&curPage=".$_REQUEST['curPage']);
			}
			
		}

		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		
		
		$data['id_list'] = implode(',',$_POST['id_list']);
		$data['id_cat'] = implode(',',$_POST['id_cat']);
		$data['id_item'] = implode(',',$_POST['id_item']);

		// $data['username'] = $_POST['username'];
		// $data['password'] = $_POST['password'];
		// $data['md5'] = md5($_POST['password']);

		$data['diachi_vi'] = $_POST['diachi_vi'];
		$data['diachi_en'] = $_POST['diachi_en'];

		$data['mota_vi'] = magic_quote($_POST['mota_vi']);
		$data['mota_en'] = magic_quote($_POST['mota_en']);

		$data['dienthoai'] = $_POST['dienthoai'];
		$data['email'] = $_POST['email'];
		$data['id_tinhthanh'] = (int)$_POST['id_tinhthanh'];
		
		$data['hoten_vi'] = $_POST['hoten_vi'];
		$data['hoten_en'] = $_POST['hoten_en'];
		$data['dienthoaiphu'] = $_POST['dienthoaiphu'];
		$data['silogan_vi'] = $_POST['silogan_vi'];
		$data['silogan_en'] = $_POST['silogan_en'];
		$data['diachilayhang_vi'] = $_POST['diachilayhang_vi'];
		$data['diachilayhang_en'] = $_POST['diachilayhang_en'];
		
		
		$data['loai_daily'] = (int)$_POST['loai_daily'];

		if(!empty($_POST['stt'])){
			$data['stt'] = $_POST['stt'];
		}

		if(!empty($_POST['hienthi'])){
			$data['hienthi'] = (int)$_POST['hienthi'];
		}

		if(!empty($_POST['moi'])){
			$data['moi'] = (int)$_POST['moi'];
		}

		if(!empty($_POST['noibat'])){
			$data['noibat'] = (int)$_POST['noibat'];
		}
		
		$data['ngaysua'] = time();
		
		$d->setTable('daily');
		$d->setWhere('id', $id);
		if($d->update($data)){
			if($_SESSION['login_admin']['type']=='daily'){
				transfer("Dữ liệu đã được cập nhật !", "index.php");
			}
			redirect("index.php?com=daily&act=man_list&curPage=".$_REQUEST['curPage']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi","index.php?com=daily&act=man_list&curPage=".$_REQUEST['curPage']."");
	}else{	
		if($photo = upload_image("file", 'jpg|png|gif|jpeg|JPG|JPEG|PNG|GIF', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
		}			


		$ngaytao=time(); // ngày tao
		$homnay = date("ymd",$ngaytao);

		$sql = "SELECT stt2 FROM table_daily order by stt2 desc limit 0,1 ";
		$result = mysql_query($sql);
		$max_stt = mysql_fetch_array($result);

		if(!empty($max_stt['stt2'])){
			$stt = $max_stt['stt2'] + 1;
		}else{
			$stt = 1;
		}
		$madaily = $homnay.$stt;
		$data['madaily'] = $madaily;
		$data['stt2'] = $stt;

		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		
		
		$data['id_list'] = implode(',',$_POST['id_list']);
		$data['id_cat'] = implode(',',$_POST['id_cat']);
		$data['id_item'] = implode(',',$_POST['id_item']);

		$data['diachi_vi'] = $_POST['diachi_vi'];
		$data['diachi_en'] = $_POST['diachi_en'];

		$data['mota_vi'] = magic_quote($_POST['mota_vi']);
		$data['mota_en'] = magic_quote($_POST['mota_en']);
		
		
		$data['hoten_vi'] = $_POST['hoten_vi'];
		$data['hoten_en'] = $_POST['hoten_en'];
		$data['dienthoaiphu'] = $_POST['dienthoaiphu'];
		$data['silogan_vi'] = $_POST['silogan_vi'];
		$data['silogan_en'] = $_POST['silogan_en'];
		$data['diachilayhang_vi'] = $_POST['diachilayhang_vi'];
		$data['diachilayhang_en'] = $_POST['diachilayhang_en'];

		// $data['username'] = $_POST['username'];
		// $data['password'] = $_POST['password'];
		// $data['md5'] = md5($_POST['password']);


		$data['dienthoai'] = $_POST['dienthoai'];
		$data['email'] = $_POST['email'];
		$data['id_tinhthanh'] = (int)$_POST['id_tinhthanh'];
		
		$data['loai_daily'] = (int)$_POST['loai_daily'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		if(!empty($_POST['moi'])){
			$data['moi'] = (int)$_POST['moi'];
		}

		if(!empty($_POST['noibat'])){
			$data['noibat'] = (int)$_POST['noibat'];
		}

		$data['ngaytao'] = $ngaytao;
		
		$d->setTable('daily');
		if($d->insert($data))
			redirect("index.php?com=daily&act=man_list&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi","index.php?com=daily&act=man_list&curPage=".$_REQUEST['curPage']."");
	}
}
function delete_list(){
	global $d,$duongdan;

	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_daily where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['thumb']);			
			}
		$sql = "delete from #_daily where id='".$id."'";
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
			$sql = "select id, photo,thumb from #_daily where id='".$id."'";
			$d->query($sql);
		
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['thumb']);
			}
			$sql = "delete from #_daily where id='".$id."'";
			$d->query($sql);
			
		} 
		redirect($duongdan);
		
	} else transfer("Không nhận được dữ liệu", $duongdan);
		
}

function check_madaily($madaily){
	global $d;	
	$d->reset();
	$sql = "select * from table_daily where madaily='$madaily'";
	$d->query($sql);
	$result = $d->fetch_array();
	if(!empty($result)){
		return true;
	}
	return false;
}

?>