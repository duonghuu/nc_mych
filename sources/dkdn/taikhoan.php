<?php if(!defined('_source')) die("Error");
		$title_tcat = _capnhattaikhoan;
		$title_bar .= _capnhattaikhoan;		
		if($_SESSION['login']['thanhvien']==''){
			transfer("Bạn phải đăng nhập mới được vào đây.", "http://$config_url/dang-nhap.htm");
		}

		$d->reset();
		$sql_user = "select * from #_member where id='".$_SESSION['login']['id_tv']."'";
		$d->query($sql_user);
		$row_thanhvien = $d->fetch_array();

		$vl =  addslashes($_SESSION['login']['id_tv']);
		if($_POST['ten_up']){
		
			if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response_cn'])) {

			    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
			    $recaptcha_secret = $config_secretkey;
			    $recaptcha_response_cn = $_POST['recaptcha_response_cn'];

			    // Make and decode POST request:
			    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response_cn);
			    $recaptcha = json_decode($recaptcha);

			    // Take action based on the score returned:
			    if ($recaptcha->score >= 0.5) {

			    	$file_name = images_name($_FILES['file']['name']);
					if($file_name = upload_image("file", 'jpg|png|JPG|PNG|JPEG|jpeg', _upload_member_l,$file_name)){
						$data['photo'] = $file_name;
						
					}
					if($_POST['password_up']!=''){
						$data['password'] = md5($_POST['password_up']);
					}
					$data['ten'] = $_POST['ten_up'];
					if($_POST['dienthoai_up']){
						$data['dienthoai'] = $_POST['dienthoai_up'];
					}

					//Lưu ngày sinh
					$ngaysinh = $_POST['ngaysinh_up'];

					$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
					if (count($Ngay_arr)==3) {
						$ngay = $Ngay_arr[0]; //17
						$thang = $Ngay_arr[1]; //11
						$nam = $Ngay_arr[2]; //2010
						if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
					}	
					$ngaysinh = strtotime($ngaysinh);
		
					$data['ngaysinh']=$ngaysinh;

				
					$data['sex'] = $_POST['sex_up'];
					$data['diachi'] = $_POST['diachi_up'];
					$d->setTable('member');
					$d->setWhere('id', $_SESSION['login']['id_tv']);
					if($d->update($data)) {
						$sql = "select * from #_member where id='".$_SESSION['login']['id_tv']."'";
						$d->query($sql);
						$row = $d->fetch_array();
						
						$_SESSION['login']['ten'] = $row['ten'];
						$_SESSION['login']['sex'] = $row['sex'];
						$_SESSION['login']['diachi'] = $row['diachi'];
						$_SESSION['login']['email'] = $row['email'];
						$_SESSION['login']['dienthoai'] = $row['dienthoai'];

						
						transfer('Cập nhật tài khoản thành công', "tai-khoan.htm");
						
					} else {
						transfer('Có lỗi xảy ra', "tai-khoan.htm");
					}
				}else{
					transfer('Có lỗi xảy ra', "tai-khoan.htm");
				}
			}

		}


	
?>


