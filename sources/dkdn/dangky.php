<?php  if(!defined('_source')) die("Error");
		$title_tcat = _dangkythanhvien;
		$title_bar .= _dangkythanhvien;

		$vl =  $_SESSION['login']['id_tv'];
		
		if(isset($_POST) && $_POST['email']){
		
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response_dk'])) {

			    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			    $recaptcha_secret = $config_secretkey;
			    $recaptcha_response_dk = $_POST['recaptcha_response_dk'];

			    // Make and decode POST request:
			    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response_dk);
			    $recaptcha = json_decode($recaptcha);

			    // Take action based on the score returned:
			    if ($recaptcha->score >= 0.5) {
				
						$reguser = $_POST['email'];
						$sql_reguser = "select * from #_member where email='$reguser'";
						$d->query($sql_reguser);
						$usercheck = $d->result_array();
						$count_usercheck = count($usercheck);
						if ($count_usercheck > 0)
						{
							transfer(_emaildangkydatontai, "index.htm");
						}
						else 
						{
				
						$data['password'] = md5($_POST['password']);
						$data['email'] = $_POST['email'];
						$data['ten'] = $_POST['ten'];
						$data['dienthoai'] = $_POST['dienthoai'];
						$data['sex'] = $_POST['sex'];
						$data['diachi'] = $_POST['diachi'];
						$data['com'] = "regular";
						$data['ngaydangky'] = time();
						
				
						//Lưu ngày sinh
						$ngaysinh = $_POST['ngaysinh'];
						$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
						if (count($Ngay_arr)==3) {
							$ngay = $Ngay_arr[0]; //17
							$thang = $Ngay_arr[1]; //11
							$nam = $Ngay_arr[2]; //2010
							if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
						}	
						$ngaysinh = strtotime($ngaysinh);
						$data['ngaysinh']=$ngaysinh;
						
						$randomkey = ChuoiNgauNhien(32);
						
						$data['randomkey'] = $randomkey;
						
						$d->setTable('member');
						
						include_once "phpMailer/class.phpmailer.php";	
						$mail = new PHPMailer();
						$mail->IsSMTP(); // Gọi đến class xử lý SMTP
						$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
						$mail->Host       = $config_ip;     // Thiết lập thông tin của SMPT
						$mail->Username   = $config_email; // SMTP account username
						$mail->Password   = $config_pass;            // SMTP account password
						
						//Thiet lap thong tin nguoi gui va email nguoi gui
						$mail->SetFrom($config_email,$row_setting["ten_$lang"]);
				
						//Thiết lập thông tin người nhận
						$mail->AddAddress($_POST["email"],$_POST["ten"]);
						$mail->AddAddress($row_setting['email'],$row_setting["ten_$lang"]);
						//Thiết lập email nhận email hồi đáp
						//nếu người nhận nhấn nút Reply
						$mail->AddReplyTo($row_setting['email'],$row_setting["ten_$lang"]);
				
						/*=====================================
						 * THIET LAP NOI DUNG EMAIL
						*=====================================*/
				
						//Thiết lập tiêu đề
						$mail->Subject    = _xacnhantaikhoan." ".$row_setting["ten_vi"]." ";
						$mail->IsHTML(true);
						//Thiết lập định dạng font chữ
						$mail->CharSet = "utf-8";	
				
							$body = '<table style="text-align:left;">';
							$body .= '
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2">'.$row_setting["ten_vi"].'</td>
								</tr>
								<tr>
									<td colspan="2">'._camonbandadangkythanhvientren.' '.$row_setting["ten_vi"]._detaikhoanthanhviencohieuluc.': </td>
								</tr>
								<tr>
									<td colspan="2"><a href="http://'.$config_url.'/kich-hoat-mail/'.$randomkey.'.html">http://'.$config_url.'/kich-hoat-mail/'.$randomkey.'.html</a></td>
								</tr>
								<tr>
									<td><b style="width:100px; float:left;">Username :</b> <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a></td>
								</tr>
								<tr>
									<td> <b style="width:100px; float:left;">Password :</b>'.$_POST['password'].'</td>
								</tr>
								<tr>
									<td colspan="2">'._neukhongphaibandadangkytaikhoan.'</td>
								</tr>
								<tr>
									<td colspan="2">'._camonbandasudungdichvucua.' '.$row_setting["ten_vi"].'</td>
								</tr>
								<tr>
									<td colspan="2">'._moithacmachoacquantamvetaikhoan.':</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2"><b>'.$row_setting["ten_$lang"].'</b></td>
								</tr>
								<tr>
									<td colspan="2">'._diachi.' : '.$row_setting["diachi_$lang"].'</td>
								</tr>
								<tr>
									<td colspan="2">'._dienthoai.' : '.$row_setting["dienthoai"].'   -  Hotline: '.$row_setting["hotline"].' Email : '.$row_setting["email"].' website : http://'.$config_url.'</td>
								</tr>
								<tr>
									<td colspan="2">'._luuydaychilathuthongbao.'</td>
				
								</tr>
								';
							$body .= '</table>';
							
							$mail->Body = $body;
							
						if($d->insert($data) && $mail->Send()) {
						
							$d->reset();
							$sql = "select id from #_newsletter where email='".$_POST['email']."'";
							$d->query($sql);
							$maill = $d->result_array();	
							
							
							if(count($maill)!=0){
								echo 1;
							} else {

								if(isset($_POST['email'])){
									$data_nt['email'] = $_POST['email'];
									$data_nt['gioitinh'] = $_POST['gioitinh'];
									$data_nt['ngaytao'] = time();
									$d->setTable('newsletter');
									if($d->insert($data_nt))
										echo 0;
									else
										echo 2;
								}
								
							}
							
							transfer(_chucmungbandadangkythanhcong, "index.html");
							
						} else
							transfer(_coloixayrakhidangky, "index.htm");
						}
				}
			}
		}
?>