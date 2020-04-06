<?php 
//echo $_SESSION['login']['username'];
if(!empty($_POST)&& isset($_POST['username'])){
	
	global $d, $login_name;
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "select * from #_thanhvien where email='".$username."'";
	
	$d->query($sql);
	if($d->num_rows() == 1){
		$row = $d->fetch_array();
		
		if($row['hienthi']!=1){
			transfer("Bạn phải kích hoạt tài khoản trước khi đăng nhập", "dang-nhap.html");
		} else { 
			if(($row['password'] == md5($password))){
				$_SESSION[$login_name] = true;
				$_SESSION['isLoggedIn'] = true;
				$_SESSION['login']['thanhvien'] = $row['thanhvien'];
				$_SESSION['login']['mathanhvien'] = $row['mathanhvien'];
				$_SESSION['login']['email'] = $row['email'];
				$_SESSION['login']['id_thanhvien'] = $row['id'];
				
				transfer("Đăng nhập thành công","trang-chu.html");
			}
		}
	}
	transfer("Tên đăng nhập hoặc mật khẩu không chính xác", "dang-nhap.html");
	}
	
	$title_bar .= "Đăng nhập"; 
?>