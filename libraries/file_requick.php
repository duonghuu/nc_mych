<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	
	$d->reset();
	$sql_setting = "select * from #_setting limit 0,1";
	$d->query($sql_setting);
	$row_setting= $d->fetch_array();

	$d->reset();
	$sql_setting = "select * from #_bgweb where type='bgweb' limit 0,1";
	$d->query($sql_setting);
	$row_background= $d->fetch_array();

	$thoigiantu=strtotime($row_setting['thoigiantu']);
    $thoigianden=strtotime($row_setting['thoigianden']);
    $thoigan=$thoigianden-time();

  $datacom = array(
  	array("tbl"=>"product","field"=>"id","source"=>"product","type"=>"product","com"=>"san-pham"),
  	array("tbl"=>"product_list","field"=>"id_list","source"=>"product","type"=>"product","com"=>"san-pham"),
  	array("tbl"=>"product_cat","field"=>"id_cat","source"=>"product","type"=>"product","com"=>"san-pham"),
  	array("tbl"=>"product_item","field"=>"id_item","source"=>"product","type"=>"product","com"=>"san-pham"),
  	
  );
	
	switch($com){
		/**************LOGIN***************/
		
		case 'ajax':
			$source = "ajax";
			break;
		
		case 'dang-ky':
			$source = "dkdn/dangky";
			$template = "dkdn/dangky";
			break;
		
		case 'dang-nhap':
			$source = "dkdn/dangnhap";
			$template ="dkdn/dangnhap";
			break;
			
		case 'dang-xuat':
			$source = "dkdn/dangxuat";
			break;
			
		case 'tai-khoan':
			$source = "dkdn/taikhoan";
			$template ="dkdn/taikhoan";
			break;
		
		case 'kich-hoat-mail':
			$source = "dkdn/kichhoatmail";
			$template ="dkdn/kichhoatmail";
			break;
			
		case 'quen-mat-khau':
			$source = "dkdn/quenmatkhau";
			$template ="dkdn/quenmatkhau";
			break;
			
		/**************LOGIN***************/
		
		case 'video':
			$source = "video";
			$template = isset($_GET['id']) ? "video_detail" : "video";
			break;
			
		case 'ban-do':
			$source = "map";
			$template ="map";
			break;
		case 'tuyen-dung':
			$source = "about";
			$template = "about";
			$title_detail = _tuyendung;
			$type_bar = 'tuyendung';
			break;



		case 'dang-nhap':
			$source = "login";
			$template ="login";
			break;
		
		case 'phan-hoi':
			$source = "gopy";
			$template = "gopy";
			break;	
		
		case 'hoi-dap':
			$source = "hoidap";
			$template ="hoidap";
			break;
			
		case 'gioi-thieu':
			$source = "about";
			$template = "about";
			$title_detail = _gioithieu;
			$type_bar = 'gioithieu';
			break;

		case 'chinh-sach-dai-ly':
			$source = "about";
			$template = isset($_GET['id']) ? "about" : "about";
			$title_detail = _chinhsachdaily;
			$type_bar = 'daily';
			break;

		case 'chinh-sach-hoi-vien':
			$source = "about";
			$template = "about";
			$title_detail = _chinhsachhoivien;
			$type_bar = 'hoivien';
			break;

		case 'hinh-anh':
			$source = "gallery";
			$template = "gallery_detail";			
			break;		

		case 'san-pham-lien-quan':
			$source = "sanphamlienquan";
			$template = "sanphamlienquan";			
			break;
		
		case 'tin-tuc':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'tintuc';
			$title_detail = _tintuc;
			break;
			

		case 'bai-viet':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'baiviet';
			$title_detail = "Bài viết";
			break;
			
			
			
		case 'ho-tro':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'hotrokhachhang';
			$title_detail = "Hỗ trợ khách hàng";
			break;	
			
			
			
		case 'khuyen-mai':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'khuyenmai';
			$title_detail = "Khuyến mãi";
			break;	
			
			
		case 'tu-van':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'tuvan';
			$title_detail = _tuvan;
			break;
		case 'su-kien':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'sukien';
			$title_detail = _sukien;
		break;
			
		case 'dich-vu':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'dichvu';
			$title_detail = _dichvu;
		break;

		case 'chinh-sach':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'header';
			$title_detail = "Chính sách cửa hàng";
		break;

		case 'cong-trinh':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'duan';
			$title_detail = _congtrinh;
		break;

		case 'hoc-bong':
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			$type_bar = 'hocbong';
			$title_detail = _hocbong;
			break;
		case 'cham-soc-khach-hang':
			$source = "chamsoc";
			$template = isset($_GET['id']) ? "chamsoc_detail" : "chamsoc";
			break;
		case 'san-pham':
			$source = "product";
			$template =isset($_GET['id']) ? "product_detail" : "product";
			$title_detail = _sanpham;
			$type_bar = 'product';	
			break;	

		case 'san-pham-cung-nghanh':
			$source = "sanpham";
			$template ="sanpham";
			$title_detail = 'Sản phẩm cùng ngành';
			$type_bar = 'product';	
			break;	

		case 'san-pham-tuong-tu':
			$source = "sanpham";
			$template ="sanpham";
			$title_detail = "Sản phẩm tương tự";
			$type_bar = 'product';	
			break;	

		case 'tag-tu-khoa':
			$source = "sanpham";
			$template ="sanpham";
			$title_detail = 'Từ khóa tìm kiếm';
			$type_bar = 'product';	
			break;	


		case 'deal-gia-soc':
			$source = "product";
			$template =isset($_GET['id']) ? "product_detail" : "product";
			$title_detail = _sanpham;
			$type_bar = 'deal-gia-soc';	
			break;	

		case 'du-an':
			$source = "duan";
			$template = isset($_GET['id']) ? "duan_detail" : "duan";				
			break;		
								
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			break;

		case 'giao-hang-toan-quoc':
			$source = "giaohang";
			$template = "giaohang";
			break;

		case 'giao-hang-nhan-tien':
			$source = "giaohangnt";
			$template = "giaohangnt";
			break;

		case 'doi-tra-hang-trong-10-ngay':
			$source = "doitra";
			$template = "doitra";
			break;

		case 'huong-dan-mua-hang':
			$source = "huongdanmuahang";
			$template = "huongdanmuahang";
			break;
		
		case 'tim-kiem':
			$source = "search";
			$template = "product";
			break;
			
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			break;
		case 'thank-you':
			$source = "thankyou";
			$template = "thankyou";
			break;

		case 'don-hang':
			$source = "donhang";
			$template = "donhang";
			break;
				
		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;
		case 'confirm':
			$source = "confirm";
			$template = "confirm";
			break;
		case 'xac-nhan':
			$source = "xacnhan";
			$template = "xacnhan";
			break;		

		default: 
			$source = "index";
			$template = "index";
			break;
	}
	//dump();
	//print_r($source.'+++'.$template);
	if($source!="") include _source.$source.".php";
	
	if($_REQUEST['com']=='logout')
	{
		session_unregister($login_name);
		header("Location:index.php");
	}			
?>