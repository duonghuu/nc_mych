<?php  if(!defined('_source')) die("Error");
	if(isAjaxRequest()){
	switch($_GET['act']){

		case 'load_huyen_nhan':
			huyen_nhan();
			break;
		case 'ship-huyen':
			ship();
			break;	
	}
	die;
	}
	die("<h2>ERROR</h2>");
	
	
	//load quận huyện nhận hàng

		function huyen_nhan(){
		global $d,$tinh;
		$matinh=$_POST['matinh'];
		
			$d->reset();
			$sql = "select ten,ma_huyen from #_huyen where matinh='".$matinh."' and hienthi=1 order by stt,id desc";
			$d->query($sql);
			$tinh = $d->result_array();
			
		echo json_encode(array("tinh"=>$tinh));
		
		
	}
	//phí ship theo tỉnh là TP HCM
	function ship(){
		global $d;
		$data['district_from']=$_POST['mahuyengui'];
		$data['district_to']=$_POST['mahuyennhan'];
		$data['Weight']=1300;
		//$data['Weight']=$_POST['Weight'];
		$data['maDV']=$_POST['maDV'];
		
		//gọi hàm GetServiceList để giao hàng nhanh gọi dịch vụ nó
		$phiship=ShippingOrder($data);
		
		//tính phí ship bên giao hàng nhanh
			
			$d->query("select gia from #_tinh where matinh='".$matinh."' and hienthi=1 order by stt,id desc");
			$gia=$d->fetch_array();
			$price = get_order_total();
			echo json_encode(array("ship"=>myformat($phiship['Items'][0]['ServiceFee']),"tienship"=>$phiship['Items'][0]['ServiceFee'],"price"=>
			myformat($price),"all"=>myformat($price+$phiship['Items'][0]['ServiceFee']),"total_price"=>($price+$phiship['Items'][0]['ServiceFee']),"mahuyennhan"=>$_POST['mahuyennhan'],false));
		
		
	}

	?>
	


