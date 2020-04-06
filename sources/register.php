<?php if(!defined('_source')) die("Error");
		$title_bar .= "Đăng ký thành viên";
		
		$time =  time();
		$mathanhvien=ChuoiNgauNhien(6).''.$time;
		
		$file_name=ten_thanhvien(tenhinh($_FILES['file']['name']));
		
		$vl =  $_SESSION['login']['id_thanhvien'];
		
		if(isset($_POST) && $_POST['email']!=''){
		
		if($_SESSION['login']['mathanhvien']==''){
		if($_POST['captcha-code'] == NULL)
		 {
		  $loi=" Bạn Chưa Nhập Mã Xác Nhận .";
		 }
		 if($_POST['captcha-code'] != $_SESSION['random_number'])
		 {
		   $loi="Mã Xác Nhận Không hợp lệ .";
		   
		 } else {
			 
		$reguser = $_POST['email'];
		$id_name = $_POST['id_name'];
		
		$d->reset();
		$sql = "select id from #_thanhvien where email='$reguser'";
		$d->query($sql);
		$kiemmail = $d->result_array();
		$count_km = count($kiemmail);
		
		$d->reset();
		$sql = "select id from #_thanhvien where thanhvien='$id_name'";
		$d->query($sql);
		$kiem_id = $d->result_array();
		
		$d->reset();
		$sql = "select id from #_phanquyen order by stt asc";
		$d->query($sql);
		$quyen = $d->result_array();
		
		
		$count_kid = count($kiem_id);
		
		if ($count_km > 0)
		{
       	 	echo "<script>alert('Email Đã Tồn Tại . vui lòng chọn email khác');</script>";
		}
		else 
		{
		if($_POST['password']!='')
		{
		$data['password'] = md5($_POST['password']);
		}
		if($company_image = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_thanhvien_l,$file_name)){
			$data['photo'] = $company_image;
		}
		$data['email'] = $_POST['email'];
		$data['thanhvien'] = ten_thanhvien($_POST['hoten']);
		$data['hoten'] = $_POST['hoten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		$data['gioitinh'] = $_POST['gioitinh'];
		$data['nganhang'] = $_POST['nganhang'];
		$data['sotaikhoan'] = $_POST['sotaikhoan'];
		$data['chutaikhoan'] = $_POST['chutaikhoan'];
		$data['chutaikhoan'] = $_POST['chutaikhoan'];
		$data['mathanhvien'] = $mathanhvien;
		$data['quyen'] = $quyen[0]['id'];
		$data['ngaytao'] = time();
		$data['hienthi'] = 0;
		
		$d->setTable('thanhvien');
		
		include_once "phpMailer/class.phpmailer.php";	
		$mail = new PHPMailer();
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = "210.2.64.70"; // tên SMTP server
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Username   = "support@demo30.ninavietnam.org"; // SMTP account username
		$mail->Password   = "123qwe!@#";  

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom('support@demo30.ninavietnam.org',$company_mail['ten']);

		//Thiết lập thông tin người nhận
		$mail->AddAddress($_POST['email'], $_POST['hoten']);
		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($company_mail['email'],$company_mail['ten']);

		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
 		*=====================================*/

		//Thiết lập tiêu đề
		$mail->Subject    = "Xác Nhận Tài Khoản  . ";
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	

			$body = '<table style="text-align:left;">';
			$body .= '
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">Bạn '.$_POST['hoten'].' Thân  Mến ! </td>
				</tr>
				<tr>
					<td colspan="2">Cảm ơn bạn đã đăng ký thành viên trên http://'.$config_url.'/ . Để kích hoạt tài khoản thành viên , bạn vui lòng nhấn vào liên kết dưới đây: </td>
				</tr>
				<tr>
					<td colspan="2"><a href="http://'.$config_url.'/kich-hoat-mail/'.ten_thanhvien($_POST['hoten']).'/'.$mathanhvien.'.htm">http://'.$config_url.'/kich-hoat-mail/'.ten_thanhvien($_POST['hoten']).'/'.$mathanhvien.'.htm</a></td>
				</tr>
				
				<tr>
					<th width="100px">Tên truy cập :</th><td> <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a></td>
				</tr>
				<tr>
					<th width="100px">Mật khẩu : </th><td>'.$_POST['password'].'</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td colspan="2"><i><b>Lưu Ý </b> : Đây là thư hổ trợ tự động , mọi phản hồi về mail này điều không được duyệt .</i></td>
				</tr>
				
				';
			$body .= '</table>';
			
			$mail->Body = $body;
			
		if($mail->Send())
		{
			$d->insert($data);
			transfer("Bạn đã đăng ký thành công<br/>Vui lòng vào email kích hoạt tài khoản", "trang-chu.html");
		}
		else
			echo "<script>alert('Đăng Ký Không Thành Công .Vui lòng đăng ký lại .');</script>";
		}
		}
		} else {
			$reguser = $_POST['email'];
			$d->reset();
			$sql = "select id from #_thanhvien where email='$reguser' and email!='".$_SESSION['login']['email']."' ";
			$d->query($sql);
			$kiemmail = $d->result_array();
			$count_km = count($kiemmail);
			if ($count_km > 0)
			{
				transfer("Email này đã tồn tại, vui lòng chọn tên khác", "dang-ky.html");
			}


			if($_POST['password']!='')
			{
			$data['password'] = md5($_POST['password']);
			}
			if($company_image = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_thanhvien_l,$file_name)){
				$data['photo'] = $company_image;
			}
			$data['email'] = $_POST['email'];
			$data['thanhvien'] = ten_thanhvien($_POST['hoten']);
			$data['hoten'] = $_POST['hoten'];
			$data['dienthoai'] = $_POST['dienthoai'];
			$data['diachi'] = $_POST['diachi'];
			$data['gioitinh'] = $_POST['gioitinh'];
			$data['nganhang'] = $_POST['nganhang'];
			$data['sotaikhoan'] = $_POST['sotaikhoan'];
			$data['quyen'] = $quyen[0]['id'];


			$d->setTable('thanhvien');
			$d->setWhere('email', $_SESSION['login']['email']);
			if($d->update($data))
					redirect("../../tai-khoan/".$_SESSION['login']['thanhvien']."/".$_SESSION['login']['mathanhvien'].".htm");
			else
				transfer("Cập nhật dữ liệu bị lỗi", "../../tai-khoan/".$_SESSION['login']['thanhvien']."/".$_SESSION['login']['mathanhvien'].".htm");
				
		}
		}
		
	
?>