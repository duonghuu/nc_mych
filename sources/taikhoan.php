<?php if(!defined('_source')) die("Error");
		
		$title_bar .= "Tài Khoản  thành viên";		
		if($_SESSION['login']['thanhvien']==''){
			transfer("Bạn phải đăng nhập mới được vào đây .", "http://$config_url/dang-nhap.htm");
		}
		
		$vl =  addslashes($_SESSION['login']['id_tv']);
		
		$d->reset();
		$sql = "select * from #_thanhvien where hienthi=1 and mathanhvien = '".$_GET['mathanhvien']."' ";
		$d->query($sql);
		$thanhvien = $d->result_array();
		
		if(count($thanhvien)==0){
			transfer("Thành viên không tồn tại . <br/>Cảm ơn", "../trang-chu.htm");
		}
	
		if(isset($_POST) && $_POST['email']){
		if($_POST['txtCaptcha'] == NULL)
		 {
		  $loi=" Bạn Chưa Nhập Mã Xác Nhận .";
		 }
		 if($_POST['txtCaptcha'] != $_SESSION['security_code'])
		 {
		   $loi="Mã Xác Nhận Không hợp lệ .";
		 }else {
		$reguser = $_POST['email'];
		$sql_reguser = "select * from #_thanhvien where email='$reguser'";
		$d->query($sql_reguser);
		$usercheck = $d->result_array();
		$count_usercheck = count($usercheck);
		
		if($_SESSION['login']['thanhvien']!=''){
		if($_POST['password']!='')
		{
		$data['password'] = md5($_POST['password']);
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
		$d->setTable('thanhvien');
		$d->setWhere('id', $vl);
		if($d->update($data))
			transfer("Bạn đã cập nhật thông tin thành công<br/>Cảm ơn", "../../tai-khoan/".$thanhvien[0]['thanhvien']."/".$thanhvien[0]['mathanhvien'].".htm");
		else
			transfer("Lưu dữ liệu bị lỗi", "dang-ky.htm");
		}
		else 
		{
		$data['thanhvien'] = $_POST['thanhvien'];
		if($_POST['new_pass']!='')
		{
		$data['password'] = md5($_POST['new_pass']);
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
		$data['ngaytao'] = time();
		$d->setTable('thanhvien');
		if($d->insert($data))
			transfer("Bạn đã đăng ký thành công<br/>Cảm ơn", "Trang-chu.htm");
		else
			transfer("Lưu dữ liệu bị lỗi", "Dang-ky.htm");
		}
		}
		}
		
		
		if(isset($_POST) && $_POST['gui_mail_cn']){
			$data['ngaytao'] = time();
			$data['nguoigui'] = $_SESSION['login']['thanhvien'];
			$data['nguoinhan'] = $_POST['nguoinhan'];
			$data['noidung'] = $_POST['noidung'];
			$d->setTable('tinnhan');
			if($d->insert($data))
				transfer("Gửi Thư Thành Công", "".$_SESSION['login']['thanhvien'].".html");
			
		}

	
?>