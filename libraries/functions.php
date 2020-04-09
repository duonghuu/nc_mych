<?php if(!defined('_lib')) die("Error");
if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}
if(!function_exists("myformat")){
   function myformat($num,$ext=' VNĐ',$default = false){
       if($num==0){
         if(!$default){
             return 0;
         }else{
             return myconfig("default_price");
         }
       }else{
           return @number_format($num, 0,'', '.').$ext;
       }
    }
}
function getCurrentPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
  $pageURL = explode("&page=", $pageURL);
    return $pageURL[0];
}
function getCurrentPageURL_CANO() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    $pageURL = str_replace("amp/", "", $pageURL);
    $pageURL = explode("&page=", $pageURL);
    $pageURL = explode("?", $pageURL[0]);
    $pageURL = explode("#", $pageURL[0]);
    $pageURL = explode("index", $pageURL[0]);
    return $pageURL[0];
}
if(!function_exists("myformat_price")){
   function myformat_price($num,$ext='',$default = false){
       if($num==0){
         if(!$default){
             return 0;
         }else{
             return myconfig("default_price");
         }
       }else{
           return @number_format($num, 0,'', '.').$ext;
       }
    }
}
function deal_price($soluongdeal,$soluongban)
{
	$ketqua = ($soluongban / $soluongdeal);
	$phantram = round($ketqua*100);
	return $phantram;	
}
function likelayout($pid)
{

  if($_SESSION['login']['id_tv'] > 0){
    echo '<span data-id="'.$pid.'" class="likebtn"><i class="fa heart"></i></span>';
  }
}
/*function getDefaultData() {
    return array(
        'ApiKey' => 'UFg2qRAkcDUypYSu',
        'ApiSecretKey' => '305712237F9526E3C506C0AF7E6841A4',
        'ClientID' => 44008,
        'Password' => 'qrcq51BaHL5FV6Gx8'
    );
}

function GetDistrictProvinceData(){
    $data = getDefaultData();
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/GetDistrictProvinceData');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $responseData = json_decode($response, true);
	return $responseData;	
	die;	
}
function HTVC(){
    $data = getDefaultData();
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/ServiceInfos');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $responseData = json_decode($response, true);
	return $responseData;	
	die;	
}
function createNewHub() {

   
    $data = getDefaultData();
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/GetPickHubs');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    $PickHubID = json_decode($response, true);
    return $PickHubID;
}

function getServiceList($postData,&$responseDataNew) {
	$data = getDefaultData();
	$data['FromDistrictCode'] =$postData['district_from'];
	$data['ToDistrictCode'] = $postData['district_to'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/GetServiceList');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $responseData = json_decode($response, true);
	 array_push($responseDataNew, array(
        'request' => $data,
        'response' => $responseData
    ));

    if (!empty($responseData['Services']) && is_array($responseData['Services'])) {
        $arrService = array();
        foreach ($responseData['Services'] as $service) {
            if (!empty($service['ShippingServiceID'])) {
                array_push($arrService, $service['ShippingServiceID']);
            }
        }
        if (!empty($arrService)) {
            $serviceID = min($arrService);
        }
    }

    return $serviceID;	
}*/


   function check($s){echo '<pre>';print_r($s);echo '</pre>';}
	function isAjaxRequest(){
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
		return true;
		return false;
	}
	function getDefaultData($key=null) {
		$data = array(
        'ApiKey' => 'UFg2qRAkcDUypYSu',
        'ApiSecretKey' => '305712237F9526E3C506C0AF7E6841A4',
        'ClientID' => 44008,
        'Password' => 'qrcq51BaHL5FV6Gx8',
		'token'=>'5a543bcc1070b0074b41f9f4'
		);
		if($key)
			return $data[$key];
		return $data;
	}
	function getTinhThanh($id_provinde=null){
		
			$def = getDefaultData();
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://console.ghn.vn/api/v1/apiv3/GetDistricts",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode(array("token"=>$def['token'])),
			  CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"postman-token: de6abf23-f03a-4981-1d85-215f58f126bc"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);
				
			if ($err) {
			  echo "cURL Error #:" . $err;die;
			}
			$data = array();
				$js = json_decode($response);
				
			if(!$id_provinde){
				
				foreach($js->data as $k=>$v){
					
					if($v->IsRepresentative){
						$data[] = array("id"=>$v->ProvinceID,"name"=>$v->DistrictName);
					}
				}
			}else{
				
				foreach($js->data as $k=>$v){
					
					if($v->ProvinceID==$id_provinde && !$v->IsRepresentative){
						
						$data[] = array("id"=>$v->DistrictID,"name"=>$v->DistrictName);
					}
				}
			}
			
			return $data;
			
	}
	function GetDistrictProvinceData(){
		$data = getDefaultData();
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://console.ghn.vn/api/v1/apiv3/GetDistricts');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, stripslashes(json_encode($data)));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		$responseData = json_decode($response, true);
		return $responseData;	
		die;	
	}
	function createNewHub() {
		
		
		$data = getDefaultData();
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/GetPickHubs');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		
		$PickHubID = json_decode($response, true);
		return $PickHubID;
	}
	function HTVC(){
		$data = getDefaultData();
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/ServiceInfos');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		$responseData = json_decode($response, true);
		return $responseData;	
		die;	
	}
	function getServiceList($postData,&$responseDataNew) {
		$data = getDefaultData();
		$data['FromDistrictCode'] =$postData['FromDistrictCode'];
		$data['ToDistrictCode'] = $postData['ToDistrictCode'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/GetServiceList');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		#check($data);die;
		$response = curl_exec($ch);
		$responseData = json_decode($response, true);
		array_push($responseDataNew, array(
        'request' => $data,
        'response' => $responseData
		));
		
		if (!empty($responseData['Services']) && is_array($responseData['Services'])) {
			$arrService = array();
			$arrService2 = array();
			foreach ($responseData['Services'] as $service) {
				if (!empty($service['ShippingServiceID'])) {
					array_push($arrService, $service['ShippingServiceID']);
					array_push($arrService2, $service['Name']);
				}
			}
			if (!empty($arrService)) {
				$serviceID = $arrService;
				$serviceName = $arrService2;
				$arr_dv = array('serviceID' =>$serviceID ,'serviceName' =>$serviceName);
			}
		}
		
		return $arr_dv;	
	}
	function getWeight(){
		global $d;
		$weight = 0;
		foreach($_SESSION['cart'] as $k=>$v){
			$d->query("select khoiluong from #_product where id = ".$v['productid']);
			$r = $d->fetch_array();
			$weight+=$r['khoiluong']*$v['qty'];
		}
		return $weight;
	}
	function getAvaialbeService($postData) {
		$curl = curl_init();
		
		$data = array();
		
		$data = array("token"=>getDefaultData("token"),"Weight"=>getWeight(),"FromDistrictID"=>$postData['FromDistrictCode'],"ToDistrictID"=>$postData['ToDistrictCode']);
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://console.ghn.vn/api/v1/apiv3/FindAvailableServices",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($data,JSON_NUMERIC_CHECK ),
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/json",
			"postman-token: a0e9f855-1eca-bb1e-a35c-8d024fcd7ee1"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;die;
		} else {
			$data = array();
			foreach(json_decode($response)->data as $k=>$v){
				$data[] = array("id"=>$v->ServiceID,"name"=>$v->Name,"fee"=>$v->ServiceFee);
			}
			
		  return ($data);
		}
		
		
		
	}
	
	
	function ShippingOrder($postData) {
		$responseData = array();
		$serviceID=getServiceList($postData,$responseData);
		$data = getDefaultData();
		//dump($serviceID);
		$data['Items']=array(array(
        'FromDistrictCode' => $postData['district_from'],
        'ToDistrictCode' => $postData['district_to'],
        'ServiceID' => $postData['ServiceID'],	
		)) 	; 
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/CalculateServiceFee');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$ship = json_decode($response, true);
		return $ship;
	}
	function createOrder($postData, $pickHub, $serviceID, &$responseDataNew,$coupon=null) {
		
		$OrderCode = 0;
		$data = getDefaultData();
		#check($postData);die;
		$insert = array(
		   'token' => $data['token'],
		   'PaymentTypeID' => 2,
		   'FromDistrictID' => $postData['district_from'],
		   'FromWardCode' => '',
		   'ToDistrictID' => $postData['district_to'],
		   'ToWardCode' => '',
		   'Note' => 'Tạo ĐH qua API',
		   'SealCode' => '',
		   'ExternalCode' => '',
		   'ClientContactName' => $postData['name_from'],
		   'ClientContactPhone' => '"'.$postData['phone_from'].'"',
		   'ClientAddress' => $postData['address_from'],
		   'CustomerName' => $postData['name_to'],
		   'CustomerPhone' =>'"'.$postData['phone_to'].'"',
		   'ShippingAddress' => $postData['address_to'],
		   'CoDAmount' => $postData['Amount'],
		   'NoteCode' => $postData['chuthich'],
		   'InsuranceFee' => 0,
		   'ClientHubID' => 0,
		   'ServiceID' => $serviceID,
		   
		   'Content' => $postData['ghichu'],
		   'CouponCode' => $coupon,
		   'Weight' => $postData['Weight'],
		  'Length' => 10,
		   'Width' => 10,
		   'Height' => 10,
		   'CheckMainBankAccount' => false,
		   /*'ShippingOrderCosts' => array (
				   'ServiceID' => 53332,
				   'ServiceType' => 5,
			),*/
		   'ReturnContactName' => '',
		   'ReturnContactPhone' => '',
		   'ReturnAddress' => '',
		   'ReturnDistrictCode' => '',
		   'ExternalReturnCode' => '',
		   'IsCreditCreate' => true,
		);
		
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://console.ghn.vn/api/v1/apiv3/CreateOrder');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($insert,JSON_NUMERIC_CHECK));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		
		$responseData = json_decode($response, true);//dump($responseData);
		
		array_push($responseDataNew, array(
        'request' => $insert,
        'response' => $responseData
		));
		
		if (!empty($responseData['data']['OrderCode'])) {
			$OrderCode = $responseData['data']['OrderCode'];
		}
		
		return $OrderCode;
		
		unset($data['token']);
		$data['PickHubID'] = $pickHub;
		$data['ServiceID'] = $serviceID;
		$data['SenderName'] = $postData['name_from'];
		$data['SenderPhone'] = $postData['phone_from'];
		$data['PickAddress'] = $postData['address_from'];
		$data['PickDistrictCode'] = $postData['district_from'];
		$data['RecipientName'] = $postData['name_to'];
		$data['RecipientPhone'] = $postData['phone_to'];
		$data['DeliveryAddress'] = $postData['address_to'];
		$data['DeliveryDistrictCode'] = $postData['district_to'];
		$data['CODAmount'] = $postData['Amount'];
		$data['ClientNote'] = $postData['chuthich'];
		$data['Weight']=$postData['Weight'];
		$data['Length']=$postData['Length'];
		$data['Width']=$postData['Width'];
		$data['paymentTypeId']=2;
		echo json_encode($data);
	check($data);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/CreateShippingOrder');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		
		$responseData = json_decode($response, true);//dump($responseData);
		
		array_push($responseDataNew, array(
        'request' => $data,
        'response' => $responseData
		));
		
		if (!empty($responseData['OrderCode'])) {
			$OrderCode = $responseData['OrderCode'];
		}
		
		return $OrderCode;
	}
	
	
	
	function createOrder2($postData, $pickHub, $serviceID, &$responseDataNew) {
		
		$OrderCode = 0;
	
		$data = getDefaultData();
		unset($data['token']);
		$data['PickHubID'] = $pickHub;
		$data['ServiceID'] = $serviceID;
		$data['SenderName'] = $postData['name_from'];
		$data['SenderPhone'] = $postData['phone_from'];
		$data['PickAddress'] = $postData['address_from'];
		$data['PickDistrictCode'] = $postData['district_from'];
		$data['RecipientName'] = $postData['name_to'];
		$data['RecipientPhone'] = $postData['phone_to'];
		$data['DeliveryAddress'] = $postData['address_to'];
		$data['DeliveryDistrictCode'] = $postData['district_to'];
		$data['CODAmount'] = $postData['Amount'];
		$data['ClientNote'] = $postData['chuthich'];
		$data['Weight']=$postData['Weight'];
		$data['Length']=$postData['Length'];
		$data['Width']=$postData['Width'];
		$data['paymentTypeId']=2;
		echo json_encode($data);
	check($data);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://apipds.ghn.vn/external/b2c/CreateShippingOrder');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		
		$responseData = json_decode($response, true);//dump($responseData);
		
		array_push($responseDataNew, array(
        'request' => $data,
        'response' => $responseData
		));
		
		if (!empty($responseData['OrderCode'])) {
			$OrderCode = $responseData['OrderCode'];
		}
		
		return $OrderCode;
	}


/*
function ampify($html='') {
    # Replace img, audio, and video elements with amp custom elements
    $html = str_ireplace(array('<img','<video','/video>','<audio','/audio>'),array('<amp-img','<amp-video','/amp-video>','<amp-audio','/amp-audio>'),$html);
    # Add closing tags to amp-img custom element
    $html = preg_replace('/<amp-img(.*?)\/?>/','<amp-img$1 layout="responsive" width="700" height="500"></amp-img>',$html);
    # Whitelist of HTML tags allowed by AMP
    $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');
    # replace style to w,h
    $html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
    return $html;
}

function seo_entities($str) {
	$res_2 = htmlentities($str, ENT_QUOTES, "UTF-8");
	$res_2 = str_replace("'","&#039;",$str);
	$res_2 = str_replace('"','&quot;',$str);
	return $res_2;
}

function getCurrentPageURL_AMP() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/amp".$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"]."/amp".$_SERVER["REQUEST_URI"];
    }
	$pageURL = explode("/page=", $pageURL);
    return $pageURL[0];
}
*/

function getInfoDaily($id){
	global $d;
	$sql="select * from #_daily where id=$id";
	$d->query($sql);
	$result=$d->fetch_array();
	return $result;
}
function getNameDaily($id,$lang){
	global $d;
	$sql="select ten_$lang from #_daily where hienthi=1 and id=$id";
	$d->query($sql);
	$result=$d->fetch_array();
	return $result['ten_'.$lang];
}

function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		return $str;
	}
	if (is_numeric($str)) {
		return $str;
	}
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}
	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}

function changArrayKey($key){
	$arrayKey=explode('-',$key);
	return  $arrayKey;
	}

function compareArray($array1,$array2){
	
	$arrrayCompare=array_intersect($array1,$array2);
	
	$tieuchuan=count($array1)-1;
	if(count($arrrayCompare)>$tieuchuan){
		
		return count($arrrayCompare);
		}else{
			
			return 0;
			}
	 
	}
function fiterArrayProduct($Keywords,$arrayData){
	
	
	
	$arraykey=changArrayKey($Keywords);	
	$resultID=array();
	$tieuchuan=count($arraykey)-1;
	$i=0;
	foreach((array)$arrayData as $k=>$v){
	 $arrayTitle=changArrayKey(changeTitle($v['ten_vi']));
	// check_array($arrayTitle);
		$Thuhang=compareArray($arraykey,$arrayTitle);
		if($Thuhang>$tieuchuan){
			$resultID[$i]['thuhang']=$Thuhang;
			$resultID[$i]['id']=$v['id'];
			
			$i++;
			}
		
		}
	//checkarray($arrayData);
	//checkarray($arraykey);
	//checkarray($resultID);
		arsort($resultID);
	//checkarray($resultID);
	 return $resultID;
 
	
	}

function get_tinh($id,$lang)
	{
	    global $d, $row,$lang;
    	$sql="select ten from #_tinh where matinh=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		
		return $row['ten'];
	}	
	

function get_quan($id,$lang)
	{
	    global $d, $row,$lang;
    	$sql="select ten from #_huyen where  ma_huyen=".$id." limit 0,1";
    	$d->query($sql);
    	$row=$d->fetch_array();
		return $row['ten'];
	}

function checkarray($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	}

function youtobi($id)
{
	$ext = explode('=',$id);
	$vaich = $ext[1];
	return $vaich;
}
function phanquyen_tv($com,$quyen,$act,$type){
	global $d;

	$text_act = explode('_',$act);
	$text_act = $text_act[1];
	
	$d->reset();
	$sql = "select * from #_phanquyen where id='".$quyen."' ";
	$d->query($sql);
	$phanquyen = $d->fetch_array();

	$d->reset();
	$sql = "select * from #_com where ten_com='".$com."' and act ='".$text_act."' and type ='".$type."' ";

	$d->query($sql);
	$com_manager = $d->fetch_array();
	
	$xem_s = json_decode($phanquyen['xem']);
	$them_s = json_decode($phanquyen['them']);
	$xoa_s = json_decode($phanquyen['xoa']);
	$sua_s = json_decode($phanquyen['sua']);

	$xem_arr = explode('|',"capnhat|man|man_list|man_cat|man_item|man_sub");
	$them_arr = explode('|',"add|add_cat|add_list|add_item|add_sub|save|save_list|save_cat|save_item|save_sub");
	$xoa_arr = explode('|',"delete|delete_list|delete_cat|delete_item,delete_sub");
	$sua_arr = explode('|',"edit|edit_list|edit_cat|edit_item|edit_sub|save|save_list|save_cat|save_item|save_sub");

	if(in_array($act,$xem_arr)){

		if(in_array($com_manager['id'].'|1',$xem_s)){
			return 1;
		} else {
			return 0;
		}
	} elseif(in_array($act,$them_arr)) {
		if(in_array($com_manager['id'].'|1',$them_s)){
			return 1;
		} else {
			return 0;
		}
	} elseif(in_array($act,$xoa_arr)){
		if(in_array($com_manager['id'].'|1',$xoa_s)){
			return 1;
		} else {
			return 0;
		}
	} elseif(in_array($act,$sua_arr)){
		if(in_array($com_manager['id'].'|1',$sua_s)){
			return 1;
		} else {
			return 0;
		}
	} else {
		return 0;
	}


			
}
function phanquyen_edit($quyen,$role,$vitri){
	global $d,$kiemtra;
	
	$d->reset();
	$sql = "select * from #_phanquyen where id='".$quyen."' ";
	$d->query($sql);
	$phanquyen = $d->fetch_array();
	
	$com_s = json_decode($phanquyen['com']);
	$vitri_s = json_decode($phanquyen['table_vitri']);
	$sua_s = json_decode($phanquyen['sua']);
	
	if($role==3){
		$kiemtra = 1;	
	} else {
		for($i=0;$i<count($vitri_s);$i++){
			if($vitri_s[$i] == $vitri ){
				if(in_array($i.'|1',$sua_s)){
					$kiemtra = 1;
				}
			} 
		}
	}
	return $kiemtra;
			
}
function fns_Rand_digit($min,$max,$num)
{
	$result='';
	for($i=0;$i<$num;$i++){
		$result.=rand($min,$max);
	}
	return $result;	
}
function get_tong_tien($id=0){
		global $d;
		if($id>0){
			$d->reset();
			$sql="select gia,soluong from #_order_detail where id_order='".$id."'";
			$d->query($sql);
			$result=$d->result_array();
			$tongtien=0;
			for($i=0,$count=count($result);$i<$count;$i++) { 
			
			$tongtien+=	$result[$i]['gia']*$result[$i]['soluong'];	
			
			}
			return $tongtien;
		}else return 0;
	}
function daxem($pid){
		if($pid<1) return;
		
		if(is_array($_SESSION['daxem'])){
			if(daxem_exists($pid)) return;
			$max=count($_SESSION['daxem']);
			$_SESSION['daxem'][$max]['productid']=$pid;
		}
		else{
			$_SESSION['daxem']=array();
			$_SESSION['daxem'][0]['productid']=$pid;
		}
	}
	function daxem_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['daxem']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['daxem'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}
function _substr($str,$n)
{
	if(strlen($str)<$n) return $str;
	$html = substr($str,0,$n);
	$html = substr($html,0,strrpos($html,' '));
	return $html.'..';
}
function giamgia($gia,$giam)
{
	$ketqua = ($gia - $giam)/($gia);
	$phantram = round($ketqua*100).'%';
	return $phantram;	
}
function upload_photos($file, $extension, $folder, $newname=''){
	if(isset($file) && !$file['error']){
		
		$ext = end(explode('.',$file['name']));
		$name = basename($file['name'], '.'.$ext);
		//alert('Chỉ hỗ trợ upload file dạng '.$ext);
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$ext.'-////-'.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$file['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$file['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$file['name'] = $newname.'.'.$ext;
		}
		
		if (!copy($file["tmp_name"], $folder.$file['name']))	{
			if ( !move_uploaded_file($file["tmp_name"], $folder.$file['name']))	{
				return false;
			}
		}
		return $file['name'];
	}
	return false;
}
function escape_str($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		
		return $str;
	}
	
	if (is_numeric($str)) {
		return $str;
	}
	
	if(get_magic_quotes_gpc()){
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}

function make_date($time,$dot='.',$lang='vi',$f=false){
	
	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);
	if($f){
		$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}
function count_online(){
/*
CREATE TABLE `camranh_online` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `session_id` varchar(255) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
*/
	global $d;
	$time = 600; // 10 phut
	$ssid = session_id();

	// xoa het han
	$sql = "delete from #_online where time<".(time()-$time);
	$d->query($sql);
	//
	$sql = "select id,session_id from #_online order by id desc";
	$d->query($sql);
	$result['dangxem'] = $d->num_rows();
	$rows = $d->result_array();
	$i = 0;
	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);
	
	if($i<$result['dangxem']){
		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";
		$d->query($sql);
		$result['daxem'] = $rows[0]['id'];
	}
	else{
		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";
		$d->query($sql);
		$result['daxem'] = mysql_insert_id();
		$result['dangxem']++;
	}
	
	return $result; // array('dangxem'=>'', 'daxem'=>'')
}

function delete_file($file){
		return @unlink($file);
}

function upload_image($file, $extension, $folder, $newname=''){
	
	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
		
		$ext = end(explode('.',$_FILES[$file]['name']));
		$name = basename($_FILES[$file]['name'], '.'.$ext);
		
		if(strpos($extension, $ext)===false){
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false; // không hỗ trợ
		}
		
		if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++){
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else{
			$_FILES[$file]['name'] = $newname.'.'.$ext;
		}
		
		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
				return false;
			}
		}
		return $_FILES[$file]['name'];
	}
	return false;
}

function chuanhoa($s){
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}

function themdau($s){
	$s = addslashes($s);
	return $s;
}

function bodau($s){
	$s = stripslashes($s);
	return $s;
}


function transfer($msg,$page="index.php")
{
	 $showtext = $msg;
	 $page_transfer = $page;
	 include("./templates/transfer_tpl.php");
	 exit();
}

function redirect($url=''){
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}

function back($n=1){
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}

function dump($arr, $exit=1){
	echo "<pre>";	
		var_dump($arr);
	echo "<pre>";	
	if($exit)	exit();
}
function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
	{
		if($curPg<1) $curPg=1;
		if($mxR<1) $mxR=5;
		if($mxP<1) $mxP=5;
		$totalRows=count($r);
		if($totalRows==0)	
			return array('source'=>NULL, 'paging'=>NULL);
		$totalPages=ceil($totalRows/$mxR);
				
		
		
		
		if($curPg > $totalPages) $curPg=$totalPages;
		
		$_SESSION['maxRow']=$mxR;
		$_SESSION['curPage']=$curPg;

		$r2=array();
		$paging="";
		
		//-------------tao array------------------
		$start=($curPg-1)*$mxR;		
		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
		#echo $start;
		#echo $end;
		
		$j=0;
		for($i=$start;$i<$end;$i++)
			$r2[$j++]=$r[$i];
			
		//-------------tao chuoi------------------
		$curRow = ($curPg-1)*$mxR+1;	
		if($totalRows>$mxR)
		{
			$from = $curPg - $mxP;	
			$to = $curPg + $mxP;
			if ($from <=0) { $from = 1;   $to = $mxP*2; }
			if ($to > $totalPages) { $to = $totalPages; }
			for($j = $from; $j <= $to; $j++) {
			   if ($j == $curPg) $links = $links . "<a class=\"paginate_active\" href=\"#\">{$j}</a>";		
			   else{				
				$qt = $url. "&p={$j}";
				$links= $links . "<a class=\"paginate_button\" href = '{$qt}'>{$j}</a>";
			   } 	   
			} //for
									
			//$paging.= "Go to page :&nbsp;&nbsp;" ;
			if($curPg>$mxP)
			{
				$paging .=" <a href='".$url."' class=\"first paginate_button\" >&laquo;</a> "; //ve dau				
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"previous paginate_button\" >&#8249;</a> "; //ve truoc
			}else{
				$paging .=" <a href='".$url."' class=\"first paginate_button paginate_button_disabled\" >&laquo;</a> "; //ve dau				
				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"previous paginate_button paginate_button_disabled\" >&#8249;</a> "; //ve truoc
			}
			$paging.=$links; 
			if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  
			{
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"next paginate_button\" >&#8250;</a> "; //ke				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"last paginate_button\" >&raquo;</a> "; //ve cuoi
			}else{
				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"next paginate_button paginate_button_disabled\" >&#8250;</a> "; //ke				
				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"last paginate_button paginate_button_disabled\" >&raquo;</a> "; //ve cuoi
			}
		}		
		$r3['curPage']=$curPg;
		$r3['source']=$r2;
		$r3['paging']=$paging;			
		$r3['totalRows']=$totalRows;		
		#echo '<pre>';var_dump($r3);echo '</pre>';
		return $r3;
	}
function catchuoi($chuoi,$gioihan){
// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt
// thì không thay đổi chuỗi ban đầu
if(strlen($chuoi)<=$gioihan)
{
return $chuoi;
}
else{
/*
so sánh vị trí cắt
với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt
nếu vị trí khoảng trắng lớn hơn
thì cắt chuỗi tại vị trí khoảng trắng đó
*/
if(strpos($chuoi," ",$gioihan) > $gioihan){
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
return $new_chuoi;
}
// trường hợp còn lại không ảnh hưởng tới kết quả
$new_chuoi = substr($chuoi,0,$gioihan)."...";
return $new_chuoi;
}
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
   	  'i'=>'í|ì|ỉ|ĩ|ị',	  
   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
     	$arr=explode("|",$codau);
   	  $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau

function pagination($query,$per_page=10,$page=1,$url='?'){   
    global $d; 

    $sql = "SELECT COUNT(*) as `num` FROM {$query}";
    $d->query($sql);
    $row = $d->fetch_array();
    $total = $row['num'];
    $adjacents = "2"; 
      
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
      
    $prev = $page - 1;                          
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination'>";
        // $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
              
            //if ($page > 1) $pagination.= "<li><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                }
               // $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
               // $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
               // $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                //$pagination.= "<li><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";
               // $pagination.= "<li><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
      
    return $pagination;
}

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}
function images_name($tenhinh)
	{
		$rand=rand(10,9999);
		$ten_anh=explode(".",$tenhinh);
		$result = changeTitle($ten_anh[0])."-".$rand;
		return $result; 
	}

function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){

// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?

$new_width   = $width;
$new_height   = $height;

 if ($new_width && !$new_height) {
        $new_height = floor ($height * ($new_width / $width));
    } else if ($new_height && !$new_width) {
        $new_width = floor ($width * ($new_height / $height));
    }
	
$image_url = $folder.$file;
$origin_x = 0;
$origin_y = 0;
// GET ORIGINAL IMAGE DIMENSIONS
$array = getimagesize($image_url);
if ($array)
{
    list($image_w, $image_h) = $array;
}
else
{
     die("NO IMAGE $image_url");
}
$width=$image_w;
$height=$image_h;

// ACQUIRE THE ORIGINAL IMAGE
$image_ext = trim(strtolower(end(explode('.', $image_url))));
switch(strtoupper($image_ext))
{
     case 'JPG' :
     case 'JPEG' :
         $image = imagecreatefromjpeg($image_url);
		 $func='imagejpeg';
         break;
     case 'PNG' :
         $image = imagecreatefrompng($image_url);
		 $func='imagepng';
         break;
	 case 'GIF' :
	 	 $image = imagecreatefromgif($image_url);
		 $func='imagegif';
		 break;

     default : die("UNKNOWN IMAGE TYPE: $image_url");
}

// scale down and add borders
	if ($zoom_crop == 3) {

		$final_height = $height * ($new_width / $width);

		if ($final_height > $new_height) {
			$new_width = $width * ($new_height / $height);
		} else {
			$new_height = $final_height;
		}

	}

	// create a new true color image
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);

	// Create a new transparent color for image
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);

	// Completely fill the background of the new image with allocated color.
	imagefill ($canvas, 0, 0, $color);

	// scale down and add borders
	if ($zoom_crop == 2) {

		$final_height = $height * ($new_width / $width);
		
		if ($final_height > $new_height) {
			
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));

		} else {

			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));

		}

	}

	// Restore transparency blending
	imagesavealpha ($canvas, true);

	if ($zoom_crop > 0) {

		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;

		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		// calculate x or y coordinate and width or height of source
		if ($cmp_x > $cmp_y) {

			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

		} else if ($cmp_y > $cmp_x) {

			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

		}

		// positional cropping!
		if ($align) {
			if (strpos ($align, 't') !== false) {
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) {
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) {
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) {
				$src_x = $width - $src_w;
			}
		}

		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

    } else {

        // copy and resize part of an image with resampling
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    }
	


$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
// SHOW THE NEW THUMB IMAGE
if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
else $func($canvas, $folder.$new_file,floor ($quality * 0.09));

return $new_file;
}
function ChuoiNgauNhien($sokytu){
$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
for ($i=0; $i < $sokytu; $i++){
	$vitri = mt_rand( 0 ,strlen($chuoi) );
	$giatri= $giatri . substr($chuoi,$vitri,1 );
}
return $giatri;
} 

function check_yahoo($nick_yahoo='nthaih'){
	$file = @fopen("http://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");
	$read = @fread($file,200);
	
	if($read==false || strstr($read,"00"))
		$img = '<img src="images/yahoo_offline.png" border="0" align="absmiddle" />';
	else
		$img = '<img src="images/yahoo_online.png" border="0" align="absmiddle"/>';
	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';
}
function limitWord($string, $maxOut){

$string2Array = explode(' ', $string, ($maxOut + 1));

if( count($string2Array) > $maxOut ){
array_pop($string2Array);
$output = implode(' ', $string2Array)."...";
}else{
$output = $string;
}
return $output;
}

function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){
	if ($totalRows<=0) return "";
	$totalPages = ceil($totalRows/$pageSize);
	if ($totalPages<=1) return "";		
	if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];
	else $currentPage = 1;
	settype($currentPage,"int");	
	if ($currentPage <=0) $currentPage = 1;	
	$firstLink = "<li><a href=\"{$url}\" class=\"left\">First</a><li>";
	$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"right\">End</a></li>";
	$from = $currentPage - $offset;	
	$to = $currentPage + $offset;
	if ($from <=0) { $from = 1;   $to = $offset*2; }
if ($to > $totalPages) { $to = $totalPages; }
	for($j = $from; $j <= $to; $j++) {
	   if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";		
	   else{				
		$qt = $url. "&p={$j}";
		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";
	   } 	   
	} //for
	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';
} // function pagesListLimit
function format_size ($rawSize)
  {
    if ($rawSize / 1048576 > 1) return round($rawSize / 1048576, 1) . ' MB';
    else 
      if ($rawSize / 1024 > 1) return round($rawSize / 1024, 1) . ' KB';
      else
        return round($rawSize, 1) . ' Bytes';
  }
  function getCurrentPageURL_AMP() {  
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"]."/amp".$_SERVER["REQUEST_URI"];
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"]."/amp".$_SERVER["REQUEST_URI"];
    }
    $pageURL = explode("&page=", $pageURL);
    return $pageURL[0];
  }
  function seo_entities($str) {
    $res_2 = htmlentities($str, ENT_QUOTES, "UTF-8");
    $res_2 = str_replace("'","&#039;",$str);
    $res_2 = str_replace('"','&quot;',$str);
    return $res_2;
  }
  class allow_some_html_tags {
      var $doc = null;
      var $xpath = null;
      var $allowed_tags = "";
      var $allowed_properties = array();

      function loadHTML( $html ) {
          $this->doc = new DOMDocument();
        #  $html = strip_tags( $html, $this->allowed_tags );
          @$this->doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));    
          $this->xpath = new DOMXPath( $this->doc );
      }
      function setAllowed( $properties = array() ) {
          foreach( $properties as $allow ) $this->allowed_properties[$allow] = 1;
      }
      function getAttributes( $tag ) {
          $r = array();
          for( $i = 0; $i < $tag->attributes->length; $i++ )
              $r[] = $tag->attributes->item($i)->name;
          return( $r );
      }
      function getCleanHTML() {
          $tags = $this->xpath->query("//*");
          foreach( $tags as $tag ) {
              $a = $this->getAttributes( $tag );
              
              foreach( $a as $attribute ) {
                  
                  if( !isset( $this->allowed_properties[$attribute] ) ){
                      $tag->removeAttribute( $attribute );
                      
                  }
              }
          }
          
          return( $this->doc->saveHTML());
      }
  }
  function genAMPVideo($id){
      return '<amp-youtube data-videoid="'.$id.'" layout="responsive" width="480" height="270"></amp-youtube>';
  }
  function LinkConvert($str) {
      $pattern = '|<a.+?href\="(.+?)".*?>(.+?)</a>|i';
      return preg_replace_callback($pattern, function ($matches) {
          // Remove quotes
          $matches[2] = strip_tags($matches[0]);
          $link = $matches[1];
          $text = $matches[2];
          return "<a href='$link'>$text</a>";
      }, $str);
  }
  function VidConvert($iframeCode,$check=false) {
      $pattern = '/<iframe\s+.*?\s+src=(".*?").*?<\/iframe>/';
      if($check){
          return preg_match_all($pattern, $iframeCode, $matches);
      }
      // Extract video url from embed code
      return preg_replace_callback($pattern, function ($matches) {
          // Remove quotes
          $youtubeUrl = $matches[1];
          $youtubeUrl = trim($youtubeUrl, '"');
          $youtubeUrl = trim($youtubeUrl, "'");
          
          // Extract id
          preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtubeUrl, $videoId);
          return $youtubeVideoId = isset($videoId[1]) ? genAMPVideo($videoId[1]) : "";
      }, $iframeCode);

  }
  function replace_img_src($img_tag) {
     $doc = new DOMDocument();
     $doc->loadHTML(mb_convert_encoding($img_tag, 'HTML-ENTITIES', 'UTF-8'));
     $tags = $doc->getElementsByTagName('img');

     foreach ($tags as $tag) {
         $old_src = $tag->getAttribute('src');
         $w_attr = $tag->getAttribute('width');
         $h_attr = $tag->getAttribute('height');
         if( $w_attr=='' && $h_attr==''){
         list($width, $height, $type, $attr) = getimagesize($old_src);
         $tag->setAttribute('height', $height);
         $tag->setAttribute('width', $width);
       }elseif($w_attr!='' && $h_attr==''){
        list($width, $height, $type, $attr) = getimagesize($old_src);
        $height=($w_attr*$height)/$width;
        $tag->setAttribute('height', $height);
        $tag->setAttribute('width', $w_attr);
        $width=$w_attr;
       }elseif($w_attr=='' && $h_attr!=''){
        list($width, $height, $type, $attr) = getimagesize($old_src);
        $width=($h_attr*$width)/$height;
        $tag->setAttribute('height', $h_attr);
        $tag->setAttribute('width', $width);
       }else{
         $width=$w_attr;
         $height=$h_attr;
       }
         if($width>=250) $tag->setAttribute('layout', 'responsive');
     }
     return $doc->saveHTML();
  }
  function ampify($html='') {
      
      $html = LinkConvert($html);
      $html = VidConvert($html);
      $html = replace_img_src($html);
      
      # Replace img, audio, and video elements with amp custom elements
      $html = str_ireplace(array('<img','<video','/video>','<audio','/audio>','<iframe','/iframe>'),array('<amp-img ','<amp-video','/amp-video>','<amp-audio','/amp-audio>','<amp-iframe','/amp-iframe>'),$html);
      # Add closing tags to amp-img custom element
          
      $comments = new allow_some_html_tags();
      $comments->setAllowed(array("class","id","src","href","width","height","tabindex","data-videoid","layout"));
      $comments->loadHTML( $html );
      $html = $comments->getCleanHTML();
      
      $html = preg_replace('/<amp-img(.*?)\/?>/','<amp-img$1 ></amp-img>',$html);
      $html = preg_replace('/<amp-youtube(.*?)\/?>/','<amp-youtube$1 ></amp-youtube>',$html);
      
      $html = preg_replace('/border=\\"[^\\"]*\\"/', '', $html); 
      $html = preg_replace('/new=\\"[^\\"]*\\"/', '', $html); 
      $html = preg_replace('/style=\\"[^\\"]*\\"/', '', $html); 
      #preg_replace('/style=\\"[^\\"]*\\"/', '', $desc); 

      
      $html = preg_replace('/<span(.*?)\/?>/','<span>',$html);
      $html = preg_replace('/<div(.*?)\/?>/','<div>',$html);
      $html = preg_replace('/<td(.*?)\/?>/','<td>',$html);
      $html = preg_replace('/<h3(.*?)\/?>/','<h3>',$html);
      $html = preg_replace('/<p(.*?)\/?>/','<p>',$html);
      $html = preg_replace('/<h2(.*?)\/?>/','<h2>',$html);
      
      $html = preg_replace('/<em(.*?)\/?>/','<em>',$html);
      $html = preg_replace('/<br(.*?)\/?>/','<br>',$html);
      
      
      $html = preg_replace('/<table(.*?)\/?>/','<table>',$html);
      
      $html = preg_replace('/<a style(.*?)\/?>/','</a>',$html);
      $html = preg_replace('/<div style(.*?)\/?>/','</div>',$html);
      $html = preg_replace('/<p style(.*?)\/?>/','</p>',$html);
      $html = preg_replace('/<span style(.*?)\/?>/','</span>',$html);
      
      $html = preg_replace('/<strong(.*?)\/?>/','<strong>',$html);
      # Whitelist of HTML tags allowed by AMP
      $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');
      # replace style to w,h
      $html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);

      return $html;
  }