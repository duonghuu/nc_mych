<?php 
//echo $_SESSION['login']['username'];
	$title_tcat = _dangnhap;
	$title_bar .=_dangnhap;
	
if(!empty($_POST)&& isset($_POST['username'])){
	
	global $d, $login_name;
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	
	
	$sql = "select * from #_member where email='".$username."'";
	
	$d->query($sql);
	if($d->num_rows() == 1){
		$row = $d->fetch_array();
		
		if($row['active']!=1){
			transfer(_banphaikichhoattaikhoantruockhidangnhap, "index.htm");
		} else { 
			if(($row['password'] == md5($password))){
			  
				$sql_lanxem = "UPDATE table_member SET lastlogin='".time()."' WHERE email ='".$username."'";
				$d->query($sql_lanxem);
				
				$_SESSION[$login_name] = true;
				$_SESSION['login']['thanhvien'] = $username;
				$_SESSION['login']['ten'] = $row['ten'];
				$_SESSION['login']['diachi'] = $row['diachi'];
				$_SESSION['login']['email'] = $row['email'];
				$_SESSION['login']['sex'] = $row['sex'];
				$_SESSION['login']['dienthoai'] = $row['dienthoai'];
				$_SESSION['login']['id_tv'] = $row['id'];
				
				// $sid = session_id();
				// $ip = getRemoteIPAddress();
				// $time = time();
				
				// $d->reset();
				// $sql = "Select * from table_sessions where sid='$sid'";
				// $d->query($sql);
				// $res = $d->fetch_array();
				
				// if($res["sid"] != ""){ 
				// 	$sqlUpdate = "UPDATE table_sessions set time='$time' where sid='$sid'";
				// 	$d->query($sqlUpdate);
				// } else {
				// 	$sqlInsert = "INSERT INTO table_sessions (sid, ip, time) VALUES ('$sid','$ip', '$time')";
				// 	$d->query($sqlInsert);
				// }
				
				
				
				
				transfer(_chucmungbandadangnhapthanhcong,"index.html");
			}
			
		}
	}
	transfer(_tendangnhaphoacmatkhaukhongdung, "index.htm");
	}
	
	 
?>