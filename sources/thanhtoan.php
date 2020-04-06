<?php
$d->reset();
$sql="select id,ten_vi from table_album where hienthi=1 order by stt asc";
$d->query($sql);
$result_mail=$d->result_array();
if($_SESSION['login']['id_tv']){
	$d->reset();
	$sql_user = "select * from #_member where id='".$_SESSION['login']['id_tv']."'";
	$d->query($sql_user);
	$thanhvien_tv = $d->fetch_array();
}



if(!empty($_POST['thanhtoan'])){
	//print_r($_POST);
	$ten_input=$_POST['ten'];
	$diachi_input=$_POST['diachi'];
	$dienthoai_input=$_POST['dienthoai'];
	$email_input=$_POST['email'];
	$phuongthuc_input=$_POST['phuongthuc'];
	$id_tinh=$_POST['id_tinh_nhan'];
	$id_huyen=$_POST['id_huyen_nhan'];
	$tienship=$_POST['tienship'];
	$d->reset();
	$sql = "select noidung_$lang from #_info where type='giaohang' ";
	$d->query($sql);
	$dieukhoan_muahang = $d->fetch_array();
	$ten_input = trim(strip_tags($ten_input));
	$dienthoai_input = trim(strip_tags($dienthoai_input));	
	$diachi_input = trim(strip_tags($diachi_input));	
	$email_input = trim(strip_tags($email_input));	
	$phuongthuc_input = trim(strip_tags($phuongthuc_input));	
	$coloi=false;
	if ($coloi==FALSE) 
	{
		$mahoadon=strtoupper (ChuoiNgauNhien(6));
		include_once "phpMailer/class.phpmailer.php";	
		$mail = new PHPMailer();
		$mail->Priority = 1;
		$mail->AddCustomHeader("X-MSMail-Priority: High");		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		// $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		// $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		// $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		// $mail->Username   = "banhangonline.mych@gmail.com";  // GMAIL username
		// $mail->Password   = "Giabao123"; 

		$mail->Host       = "120.72.119.3";   // tên SMTP server
				$mail->Username   = "info@mych.vn"; // SMTP account username
				$mail->Password   = "Q6PDItKx2"; 
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($row_setting['email'],$row_setting['ten_'.$lang]);
		$mail->AddAddress($row_setting['email'],$row_setting['ten_'.$lang]);
		$mail->AddAddress($email_input, $ten_input);
		for($m=0;$m<count($result_mail);$m++){
			$mail->AddAddress($result_mail[$i]['ten_vi'],$result_mail[$i]['ten_vi']);
		}
		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
		*=====================================*/
		//Thiết lập tiêu đề
		$mail->Subject    = '['.$_POST['ten'].']';
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	
		$body = '<table border="0" width="100%">';
		$body .= '
		<tr>
		<th align="left" colspan="2">
		<table width="100%">
		<tr>
		<td><font size="4">Thông tin đặt hàng từ website <a href="http://www.'.$config_url.'">www.'.$config_url.'</a></font> 
		</td>
		<td align="right";><img src="http://www.'.$config_url.'/'._upload_hinhanh_l.$banner_top[0]['photo_vi'].'" ></td>
		</tr>
		</table>
		</th>
		</tr>
		<tr>
		<th width="30%" align="left">Mã đơn hàng :</th>
		<td>&nbsp; '.$mahoadon.'</td>
		</tr>
		<tr>
		<th width="30%" align="left">Họ tên :</th>
		<td>&nbsp; '.$_POST['ten'].'</td>
		</tr>
		<tr>
		<th align="left">Email :</th>
		<td>&nbsp; '.$_POST['email'].'</td>
		</tr>
		<tr>
		<th align="left">Điện thoại :</th>
		<td>&nbsp; '.$_POST['dienthoai'].'</td>
		</tr>
		<tr>
		<th align="left">Địa chỉ:</th>
		<td>&nbsp; '.$_POST['diachi'].'</td>
		</tr>
		<tr>
		<th align="left">Tỉnh/Thành:</th>
		<td>&nbsp; '.$id_tinh.'</td>
		</tr>
		<tr>
		<th align="left">Quận/Huyện:</th>
		<td>&nbsp; '.$id_huyen.'</td>
		</tr>
		<tr>
		<th align="left">Phương thức thanh toán:</th>
		<td>&nbsp; '.$_POST['phuongthuc'].'</td>
		</tr>
		<tr>
		<th align="left" colspan="2">&nbsp;</th>
		</tr>
		';
		$body.='
		<tr>
		<td height="19" colspan="2" align="right" valign="top" class="content" style="background: #D2E6DD;"><span class="cat"></span>
		<table border="1" bordercolor="#0099CC" align="center" cellpadding="5px" cellspacing="5px" width="100%">';
		if(is_array($_SESSION['cart']))
		{
			$body.='<tr bgcolor="#16AAB8">
			<td>Thứ tự</td>
			<td>Hình ảnh</td>
			<td>Tên</td>
			<td>Size</td>
			<td>Màu</td>
			<td>Giá</td>
			<td>Số lượng</td>
			<td>Tổng giá</td>
			</tr>';
			$max=count($_SESSION['cart']);
			$tonggiam = 0;
			$trongluong=0;
			$a_ngaygiao=array();
			foreach($_SESSION['cart'] as $k =>$v){
				$code = $k;
				$pid=$v['productid'];
				$q=$v['qty'];
				$pgia=$v['gia'];
				$psize=$v['size'];
				$color=$v['mausp'];
				$a_ngaygiao[]=get_product_tggiao($pid);
				$pname=get_product_name($pid);
				$weight = get_product_kl($pid)*$q;
				$trongluong = $trongluong + $weight;
				if($q==0) continue;
				$body.='<tr><td>'.($i+1).'</td>';
				$body.='<td> <a href="http://'.$config_url.'/san-pham/'.changeTitle($pname).'.html" target="_blank"><img src="http://'.$config_url.'/upload/product/'.get_thumb($pid).'" width="70" /></a></td>';
				$body.='<td><a href="http://'.$config_url.'/san-pham/'.changeTitle($pname).'.html" target="_blank">'.$pname.'</a></td>';
				$body.='<td>'.get_size($pid,$psize).'</td>';
				$body.='<td>'.$color.'</td>';
				$body.='<td>'.number_format(get_gia($pid,$pgia),0, ',', '.').'&nbsp;VND</td>';
				$body.='<td>'.$q.'</td>';                 
				$body.='<td>'.number_format(get_gia($pid,$pgia)*$q,0, ',', '.') .'&nbsp;VND</td>
				</tr>';
			}
			$body.='<tr><td colspan="6">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr><td> '; 
			$body.='<b> Tổng giá : '. number_format(get_order_total(),0, ',', '.') .' &nbsp;VND</b></td>
			<td> '; 
			$body.='<b> Tiên ship : '. number_format($tienship,0, ',', '.') .' &nbsp;VND</b></td>
			<td> '; 
			$body.='<b> Thanh Toán : '. number_format(get_order_total()+$tienship,0, ',', '.') .' &nbsp;VND</b></td>
			</tr>
			</table>
			</td></tr>';
		}
		else{
			$body.='<tr bgColor="#FFFFFF"><td>There are no items in your shopping cart!</td>';
		}
		$body.=' </table><span class="cat"></span>
		</td>
		</tr>';
		$body.='
		<tr>
		<th align="left" colspan="2">&nbsp;</th>
		</tr>
		<tr><td colspan="2" align="left">
		<p><h2>'.$row_setting['ten_vi'].'</h2></p>
		<p>Địa chỉ : '.$row_setting['diachi_vi'].'</p>
		<p>Điện thoại : '.$row_setting['hotline'].'</p>
		<p>Email : '.$row_setting['email'].'</p>
		<p>Website : <a href="'.$row_setting['website'].'">'.$row_setting['website'].'</a></p>
		<td> <tr>'; 
		$body .= '</table>';
		
		$ngaytao=time();
		$tonggia=get_order_total()+$tienship;
		$sql_order = "INSERT INTO  table_order (madonhang,hoten,dienthoai,diachi,email,httt,tonggia,tienship,ngaytao,trangthai,id_tinh,id_huyen) 
		VALUES ('$mahoadon','$ten_input','$dienthoai_input','$diachi_input','$email_input','$phuongthuc_input','$tonggia','$tienship','$ngaytao','1','$id_tinh','$id_huyen')";	  
			// Thêm đơn hàng vào Database
			mysql_query($sql_order) or die(mysql_error());
			$id_order_inserted = mysql_insert_id(); //lấy id của đơn hàng vừa lưu thành công
			// Duyệt từ phần tử trong giỏ hàng để lưu vào chi tiết đơn hàng
			$_SESSION['thanks']["email"]= $email_input;
			$_SESSION['thanks']["madon"]= $mahoadon;
			$_SESSION['thanks']["tggiao"]= $a_ngaygiao;
			$_SESSION['thanks']["diachi"]= $diachi_input;
			$_SESSION['thanks']["id_tinh"]= $id_tinh;
			$_SESSION['thanks']["id_huyen"]= $id_huyen;
			foreach($_SESSION['cart'] as $item_cart) {
				$psize=$item_cart['size'];
				$mausp=$item_cart['mausp'];
				$pgia=$item_cart['gia'];
				$q=$item_cart['qty'];
				$pname = get_product_name($item_cart['productid']);
				$gia = get_gia($item_cart['productid'],$pgia);	
				$weight = get_product_kl($pid)*$q;
			// lấy dữ liệu cho từng sản phẩm trong giỏ hàng
				$d->reset();
				$sql = "select ten_$lang,id,id_daily,tenkhongdau,photo,gia,giacu,soluongban,soluongton from table_product where id='".$item_cart['productid']."'";
				$d->query($sql);
				$item_pro = $d->fetch_array(); 
				if ($item_pro['gia']!="")
				{
					$price_item = $item_pro['gia'];
				}
				else 
				{
					$price_item = $item_pro['giacu'];
				}
			// đơn giá của từng item (màu + giảm giá + option)
				// lưu vào bảng chi tiết đơn hàng
				$sql_order_detail = "INSERT INTO  table_order_detail (id_order,id_product,id_daily,ten,gia,size,mau,soluong,weight) 
				VALUES ('$id_order_inserted','$item_pro[id]','$item_pro[id_daily]','$pname','$gia','$psize','$mausp','$item_cart[qty]','$weight')";	
				mysql_query($sql_order_detail) or die(mysql_error());
				$type_pro = get_product($item_pro['id']);
				if($type_pro['type']=='deal-gia-soc'){
					$data['soluongban'] = $item_pro['soluongban']+ $item_cart['qty'];
					$d->reset();
					$d->setTable('product');
					$d->setWhere('id',$item_pro['id']);
					$d->update($data);
				}else{
					if($item_pro['soluongton'] > 0){
						$data['soluongton'] = $item_pro['soluongton'] - $item_cart['qty'];
						$d->reset();
						$d->setTable('product');
						$d->setWhere('id',$item_pro['id']);
						$d->update($data);
					}
				}
			}
			$mail->Body = $body;
			if(!$mail->Send()) {
				transfer( "Có lỗi xảy ra!","index.html");
			} else {
				// unset($_SESSION['cart']); 
				// transfer("Gửi đơn hàng thành công!<br/>", "index.html");
				redirect("confirm.html");	
			}	
		}
	}
	$title_bar .= "Thanh Toán";
	?>