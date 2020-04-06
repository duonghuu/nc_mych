<?php if(!defined('_source')) die("Error");
		
		$d->reset();
		$sql_user = "select * from #_thanhvien where email='".$_POST['email']."'";
		$d->query($sql_user);
		$row_user = $d->result_array();
		
		$d->reset();
		$sql = "select * from #_company limit 0,1";
		$d->query($sql);
		$company_mail = $d->fetch_array();
		
		if($_GET['loai']!=''){
			
			$d->reset();
			$sql = "select email from #_thanhvien where mathanhvien = '".$_GET['loai']."'";
			$d->query($sql);
			$email_thanhvien = $d->result_array();
		
			$mathanhvien=ChuoiNgauNhien(8);
			$data['password'] = md5($mathanhvien);
			$d->setTable('thanhvien');
			$d->setWhere('mathanhvien', $_GET['loai']);
			if($d->update($data)){
				$thongbao = "true";
			} else {
				$thongbao = "false";	
			}
		}
		
		$title_bar .= "Xác Nhận Mật Khẩu";
		if(!empty($_POST)){
			
			$email  = $_POST['email'];
			
			include_once "phpMailer/class.phpmailer.php";	
		$mail = new PHPMailer();
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = "210.2.64.69"; // tên SMTP server
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Username   = "support@vnhieu.vn"; // SMTP account username
		$mail->Password   = "123qwe!@#";  

		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom('support@vnhieu.vn',$company_mail['ten']);

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
			$body = '<table style="text-align:left">';
			$body .= '
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="2">Thông báo Từ :  <a href="http://www.vnhieu.vn">www.vnhieu.vn</a></th>
				</tr>
				<tr>
					<th colspan="2">Ai đó đã dùng email này để lấy lại password thành viên của bạn trên trang  www.vnhieu.vn . Nếu đúng là bạn muốn lấy lại password xin vui lòng nhấn vào links bên dưới để lấy lại thông tin đăng nhập của bạn .</th>
				</tr>
				
				<tr>
					<th colspan="2"><a href="http://vnhieu.vn/quen-mat-khau/'.$row_user[0]['mathanhvien'].'/'.$row_user[0]['thanhvien'].'.html">Nhấn Vào Đây . </a></td>
				</tr>
				<tr>
					<th colspan="2">Nếu bạn không yêu cầu lấy lại pass vui lòng bỏ qua email này của chúng tôi .</th>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<th colspan="2"><i>Lưu ý : đây là mail trả lời tự động , mọi phản hồi về email trên sẻ không được duyệt .</i> .</th>
				</tr>
			';
			$body .= '</table>';
			
			$mail->Body = $body;
			
			if($mail->Send()) 
			transfer("Bạn Vui Lòng Check Mail Để Lấy Xem Pass Của Bạn.<br>Cảm ơn.", "dang-nhap.html");
			
			else transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "dang-nhap.html");
		}
?>