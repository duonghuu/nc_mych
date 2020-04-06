<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
// print_r($_SESSION['login_admin']);
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_user'])) ? "&id_user=".addslashes($_REQUEST['id_user']) : "";
$urldanhmuc.= (isset($_REQUEST['datefm'])) ? "&id_user=".addslashes($_REQUEST['datefm']) : "";
$urldanhmuc.= (isset($_REQUEST['dateto'])) ? "&id_user=".addslashes($_REQUEST['dateto']) : "";
$urldanhmuc.= (isset($_REQUEST['status'])) ? "&status=".addslashes($_REQUEST['status']) : "";

$id=$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "order_daily/items";
		break;

	case "edit":		
		get_item();
		$template = "order_daily/item_add";
		break;
	case "save":
		save_item();
		break;

	default:
		$template = "index";
}

#====================================

function get_items(){		
	global $d, $items, $url_link,$totalRows , $pageSize, $offset;


	$where = "where id_daily='".$_SESSION['login_admin']['id_daily']."'";
	
	
	
	if($_GET["ngaybd"]!=''){
	$ngaybatdau = $_GET["ngaybd"];		
	$Ngay_arr = explode("/",$ngaybatdau); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[1]; //17
		$thang = $Ngay_arr[0]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ 
			$coloi=true; 
			$error_ngaysinh = "Bạn nhập chưa đúng định dạng ngày<br>";
		}
		else $ngaybatdau=mktime(0,0,0,$thang,$ngay,$nam);
	}	
		$where_order.=" and ngaytao>=".$ngaybatdau." ";
	}
	
	
	if($_GET["ngaykt"]!=''){
	$ngayketthuc = $_GET["ngaykt"];		
	$Ngay_arr = explode("/",$ngayketthuc); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[1]; //17
		$thang = $Ngay_arr[0]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ 
			$coloi=true; 
			$error_ngaysinh = "Bạn nhập chưa đúng định dạng ngày<br>";
		} 
		//3 October 2005
		else $ngayketthuc=mktime(23,59,59,$thang,$ngay,$nam);
	}	
		$where_order.=" and ngaytao<=".$ngayketthuc." ";
	}
	
	
	if($_GET["keyword"]!=''){
		$where_order.=" and (madonhang like '%".$_GET["keyword"]."%' or hoten like '%".$_GET["keyword"]."%' )  ";
	}
	
	
	//sotien
	if($_GET["sotien"]!='' && $_GET["sotien"]>0){
		$sql="select giatu,giaden from #_giasearch where id='".$_GET["sotien"]."'";
		$d->query($sql);
		$giatim=$d->fetch_array();
		if($giatim!=null){
			$where.=" and (gia*soluong) >=".$giatim['giatu']." and (gia*soluong)<=".$giatim['giaden']." ";			
		}
	}
	
	//httt
	if($_GET["httt"]!='' && $_GET["httt"] > 0){
		$where_order.=" and type_payment=".$_GET["httt"]." ";
	}
	//tinhtrang
	if($_GET["tinhtrang"]!='' && $_GET["tinhtrang"]>0){
		$where.=" and trangthai=".$_GET["tinhtrang"]." ";
	}
	
	if (!empty($_REQUEST))
	{
		$sql_order="select DISTINCT id as id from table_order where id $where_order";
	}
	
	if (!empty($_REQUEST))
	{
	$where .= " and id_order IN ($sql_order)";
	}
								
	$sql="SELECT count(id) AS numrows FROM #_order_detail $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select * from #_order_detail $where order by id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	
	//print_r($sql);
	
	$url_link='index.php?com=order_daily&act=man';		
}

function get_item(){
	global $d, $item,$result_ctdonhang,$pro_cart;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	
	$d->reset();
	$sql="select * from #_order_detail where id = '".$id."'";
	$d->query($sql);
	$item=$d->fetch_array();

	$d->reset();
	$sql="select * from table_product where id='".$item['id_product']."'";
	$d->query($sql);
	$pro_cart=$d->fetch_array();
}

function save_item(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=order_daily&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){		
		$data['ghichu'] = $_POST['ghichu'];		
		$data['trangthai'] = $_POST['id_tinhtrang'];
		$d->setTable('order_detail');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=order_daily&act=man&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=order_daily&act=man");
	}
}

?>