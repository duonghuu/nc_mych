<?php
	session_start();
	error_reporting(0);
	@define ( '_template' , '../templates/');
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	$d = new database($config['database']);

	@$city = (string)$_POST['id_city'];
	@$dist = (string)$_POST['id_dist'];
	@$soluong = (int)$_POST['soluong'];
	@$trongluong = (int)$_POST['trongluong'];
	$totalorder = get_order_total();
	$data = array(
			    "pick_province" => $config['tinh-active'],
			    "pick_district" => $config['quan-active'],
			    "province" => $city,
			    "district" => $dist,
			    "address" => "",
			    "weight" => $trongluong * $soluong,
			    "transport" => "road ",
			    // "value" => $totalorder,
			);

	$curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/fee?" . http_build_query($data),
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			    CURLOPT_HTTPHEADER => array(
			        "Token: ".$config['key_ghtk'],
			    ),
			));

	$response = curl_exec($curl);
	curl_close($curl);
	$actx = json_decode($response,true);
	if($actx['success']==1){
		$phiship = $actx['fee']['fee'];
		$tongorder = $totalorder+$actx['fee']['fee'];
	}
	$array_list = array(
    	'phiship' => number_format($phiship,0, ',', '.').' đ',
		'tongorder' => number_format($tongorder,0, ',', '.').' đ',
		'numbphiship' => $phiship
	);
	echo json_encode($array_list);die();
?>