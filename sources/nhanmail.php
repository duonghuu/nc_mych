<?php if(!defined('_source')) die("Error");
		
		$title_bar .= " - Dang ky";

	
		if(!empty($_POST)&&isset($_POST['nhanmail'])){

  			
			
		
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['tieude'];
		$data['noidung'] = $_POST['noidung'];
		$data['ngaytao'] = time();
		

		$d->setTable('nhanmail');
		if($d->insert($data))
			transfer("Bạn đã đăng ký thành công<br/>Cảm ơn", "index.php");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=register");
		}
		
	
		
	
?>