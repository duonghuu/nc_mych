<?php
	session_start();
	error_reporting(0);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	$lang = 'vi';

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."type.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$login_name = 'NINACO';	
	$d = new database($config['database']);	

	$id = (int)$_GET['id'];

	$d->reset();
    $d->query("select id,madonhang,hoten,diachi,dienthoai,email,httt,tonggia,id_tinh,id_huyen,tienship from table_order where id='".$id."' order by id asc");
    $order = $d->fetch_array();


    $d->reset();
    $d->query("select * from table_order_detail where id_order='".$order['id']."' order by id asc");
    $order_detail = $d->result_array();

    $mdh = $order['madonhang'];
	$hoten = $order['hoten'];
	$diachi = $order['diachi'];
	$dienthoai = $order['dienthoai'];
	$email = $order['email'];
	$city = $order['id_tinh'];
	$dist = $order['id_huyen'];
	$tonggia = $order['tonggia'];
	$phiship = $order['tienship'];
	$ngay = date('Y-m-d');

	$item['products'] = null;
	for($k=0;$k<count($order_detail);$k++){
		$d->reset();
    	$d->query("select ten_vi,Weight from table_product where id='".$order_detail[$k]['id_product']."' order by id asc");
    	$product = $d->fetch_array();
		$item['products'][] = array(
			"name"=> $product['ten_vi'],
	        "weight"=> $order_detail[$k]['weight'],
	        "quantity"=> $order_detail[$k]['soluong']
		);
	}


	$item['order'] = array(
		'pick_name'	=>	$config['name-active'],
		'pick_money'	=>	$tonggia-$phiship,
		'pick_address'	=>	$config['address-active'],
		'pick_district'	=>	$config['quan-active'],
		'pick_province'	=>	$config['tinh-active'],
		'pick_tel'	=>	$config['tel-active'],
		'id'	=>	$order['madonhang'],
		'name'	=>	$order['hoten'],
		'address'	=>	$order['diachi'],
		'district'	=>	$order['id_huyen'],
		'province'	=>	$order['id_tinh'],
		'tel'	=>	$order['dienthoai'],
		'email'	=>	$order['email'],
		'note'	=>	$order['ghichu'],
		'value'	=>	$order['tonggia']-$phiship,
		'is_freeship'	=>	0
	);

	$eatc = json_encode($item);
	

	$order_ghtk = <<<HTTP_BODY
$eatc
HTTP_BODY;


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $order_ghtk,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Token: ".$config['key_ghtk'],
        "Content-Length: " . strlen($order_ghtk),
    ),
));

$response = curl_exec($curl);
curl_close($curl);

$xuat = json_decode($response,true);
//print_r($xuat);die();

if($xuat['success']==true){
	$ngaytao = time();
	$label = $xuat['order']['label'];
	$message = $xuat['message'];
	$deliver_time = $xuat['order']['estimated_deliver_time'];
	$pick_time = $xuat['order']['estimated_pick_time'];
	$sql = "INSERT INTO  table_giaohang (madonhang,tonggia,phiship,label,ngaytao,deliver_time,pick_time,trangthai,message ) VALUES ('$mdh','$tonggia','$phiship','$label','$ngaytao','$deliver_time','$pick_time','1','$message')";	
				mysql_query($sql) or die(mysql_error());
	transfer('Gửi đơn hàng qua giao hàng tiết kiệm thành công','index.php?com=order&act=man');
}else{
	$ngaytao = time();
	$label = $xuat['error']['ghtk_label'];
	$message = $xuat['message'];
	$partner_id = $xuat['error']['partner_id'];
	if($partner_id==$mdh){
		$sqlUPDATE_ORDER = "UPDATE table_giaohang SET trangthai = 0 WHERE  madonhang = '".$partner_id."'";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		transfer('Đơn hàng này đã được tạo bên giao hàng tiết kiệm','index.php?com=order&act=man');
	}else{
		$sql = "INSERT INTO  table_giaohang (madonhang,tonggia,phiship,label,ngaytao,trangthai,message) VALUES ('$partner_id','$tonggia','$phiship','$label','$ngaytao','0','$message')";	mysql_query($sql) or die(mysql_error());
		transfer('Lỗi tạo đơn hàng bên giao hàng tiết kiệm','index.php?com=order&act=man');
	}
	
}

?>