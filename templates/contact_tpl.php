<?php 

include_once "phpMailer/class.phpmailer.php";	
$mail = new PHPMailer();
$mail->Priority = 1;
$mail->AddCustomHeader("X-MSMail-Priority: High");		
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Username   = "mailtransnina@gmail.com";  // GMAIL username
$mail->Password   = "etvdzuqvkdwporgv"; 

// $mail->Host       = "120.72.119.3";   // tên SMTP server
// 		$mail->Username   = "info@mych.vn"; // SMTP account username
// 		$mail->Password   = "Q6PDItKx2"; 
		// $config_email="info@mych.vn";
		// $config_pass="Q6PDItKx2";
		// $config_ip="120.72.119.3";
//Thiet lap thong tin nguoi gui va email nguoi gui
$mail->SetFrom($row_setting['email'],$row_setting['ten_'.$lang]);
$mail->AddAddress('huuduongnina@gmail.com',$row_setting['ten_'.$lang]);
$mail->Subject    = 'afadfsdf';
$mail->IsHTML(true);
//Thiết lập định dạng font chữ
$mail->CharSet = "utf-8";	
$body = 'xxx22';
$mail->Body = $body;
$mail->Send();
 ?>
<script language="javascript" src="js/my_script.js"></script>
<script language="javascript">
function js_submit12(){
	if(isEmpty(document.getElementById('ten'), "Xin nhập Họ tên.")){
		document.getElementById('ten').focus();
		return false;
	}
	if(isEmpty(document.getElementById('diachi'), "Xin nhập Địa Chỉ.")){
		document.getElementById('diachi').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('dienthoai'), "Xin nhập Số điện thoại.")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	
	if(!isPhone(($('#dienthoai').val()), "Số điện thoại không hợp lệ.")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	
	if(!check_email(document.frm.email.value)){
		alert("Email không hợp lệ");
		document.frm.email.focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('tieude'), "Xin nhập Chủ đề.")){
		document.getElementById('tieude').focus();
		return false;
	}
	
	if(isEmpty(document.getElementById('noidung'), "Xin nhập Nội dung.")){
		document.getElementById('noidung').focus();
		return false;
	}
	
	document.frm.submit();
}
</script>
<div id="info">
<div id="sanpham">
           
   <div class="khung">
   <div class="thanh_title"><h2><?=_contact?></h2></div>

   <div class="khung_trai">

		<div class="form_contact">
			<p><?=$row_detail['noidung_'.$lang]?></p>
		</div>

		<div class="form_lh">
		<form method="post" name="frm" action="lien-he.html">
		<fieldset>
			<legend>Form liên hệ</legend>
	        <p><label><?=_hovaten?> : </label><b style="color:#990000;">*</b><input name="ten" type="text" class="tflienhe" id="ten" /></p>
	        <p><label><?=_address?> : </label><b style="color:#990000;">*</b><input name="diachi" type="text"  class="tflienhe" id="diachi"/></p>
			<p><label><?=_dienthoai?> : </label> <b style="color:#990000;">*</b><input name="dienthoai" type="text" class="tflienhe" id="dienthoai"/></p>
			<p><label>Email : </label><b style="color:#990000;">*</b><input name="email" type="text" class="tflienhe" id="email"  /></p>
			<p><label><?=_chude?> : </label><b style="color:#990000;">*</b><input name="tieude" type="text" class="tflienhe" id="tieude" /></p>
			<p><label><?=_noidung?> : </label><b style="color:#990000;">*</b>
			<textarea name="noidung" cols="50" rows="5" class="ta_noidung" id="noidung" style="background-color:#FFFFFF; color:#666666;"></textarea>
			</p>
	        <p><label>&nbsp </label>
	            <button type="button" onclick="js_submit12();"> Gửi liên hệ</button>
	            <button type="reset">Reset</button>   
	        </p> 
	        </fieldset>              
	    </form>
		</div>
    </div>
         
		   <script type="text/javascript">
		   var map;
		   var infowindow;
		   var marker= new Array();
		   var old_id= 0;
		   var infoWindowArray= new Array();
		   var infowindow_array= new Array();function initialize(){
			   var defaultLatLng = new google.maps.LatLng(<?=$row_setting['toado']?>);
			   var myOptions= {
				   zoom: 16,
				   center: defaultLatLng,
				   scrollwheel : true,
				   mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);map.setCenter(defaultLatLng);
			    
			   var arrLatLng = new google.maps.LatLng(<?=$row_setting['toado']?>);
			   infoWindowArray[7895] = '<div class="map_description"><div class="map_title"><h2><?=$row_setting['ten_'.$lang]?></h2></div><b><?=_address?> :</b> <?=$row_setting['diachi_'.$lang]?><br><b> <?=_dienthoai?>: </b><?=$row_setting['dienthoai']?><br><b> Fax : </b><?=$row_setting['fax']?>  <br><b> Email : </b><?=$row_setting['email']?></div>';
			   loadMarker(arrLatLng, infoWindowArray[7895], 7895);
			   
			   moveToMaker(7895);}function loadMarker(myLocation, myInfoWindow, id){marker[id] = new google.maps.Marker({position: myLocation, map: map, visible:true});
			   var popup = myInfoWindow;infowindow_array[id] = new google.maps.InfoWindow({ content: popup});google.maps.event.addListener(marker[id], 'mouseover', function() {if (id == old_id) return;if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;});google.maps.event.addListener(infowindow_array[id], 'closeclick', function() {old_id = 0;});}function moveToMaker(id){var location = marker[id].position;map.setCenter(location);if (old_id > 0) infowindow_array[old_id].close();infowindow_array[id].open(map, marker[id]);old_id = id;}</script>
      <div class="khung_phai"><div id="map_canvas"></div></div>
 
      </div></div></div>