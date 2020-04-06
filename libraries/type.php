<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";	
	switch($type){
		//-------------product------------------
		case 'product':
			$title_main = "Sản Phẩm";
			$config_images = "true";
			$config_mota= "true";
			$config_list = "true";
			$config_cat = "true";
			$config_item = "true";
			$config_sub = "false";
			@define ( _width_thumb , 238 );
			@define ( _height_thumb , 195 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;

		case 'deal-gia-soc':
			$title_main = "Deal giá sốc";
			$config_images = "true";
			$config_mota= "true";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			@define ( _width_thumb , 238 );
			@define ( _height_thumb , 195 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;
			
		case 'tintuc':
			$title_main = "Tin tức";
			$config_images = "true";
			$config_mota= "true";
			$config_list = "true";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noidung = "true";
			@define ( _width_thumb , 230 );
			@define ( _height_thumb , 190 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;
			
			
		case 'khuyenmai':
			$title_main = "Khuyến mãi";
			$config_images = "true";
			$config_mota= "true";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noibat = "false";
			$config_noidung = "true";
			@define ( _width_thumb , 230 );
			@define ( _height_thumb , 190 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;	

		case 'mausp':
			$title_main = "Tin tức";
			$config_images = "true";
			$config_mota= "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noidung = "false";
			@define ( _width_thumb , 30 );
			@define ( _height_thumb , 30 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 6;
			break;

		case 'header':
			$title_main = "Bài viết header";
			$config_images = "true";
			$config_mota= "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_img = "false";
			$config_noidung = "true";
			@define ( _width_thumb , 86 );
			@define ( _height_thumb , 86 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;
		
		case 'album':
			$title_main = "Album";
			$config_images = "false";
			$config_list = "false";
			$config_mota= "false";
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			@define ( _width_thumb , 200 );
			@define ( _height_thumb , 160 );
			@define ( _style_thumb , 1 );
			$ratio_ = 1;
			break;
		case 'album_list':
			$title_main = "danh mục album";
			$config_images = "true";
			$config_list = "false";
			@define ( _width_thumb , 200 );
			@define ( _height_thumb , 160 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;
		//-------------info------------------
		case 'gioithieu':
			$title_main = "Giới thiệu";
			$config_images = "true";
			$config_mota= "true";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noidung = "true";
			@define ( _width_thumb , 230 );
			@define ( _height_thumb , 190 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;

		case 'tggiao':
			$title_main = "Thời gian giao hàng";
			$config_images = "false";
			$config_giaban = "true";
			$config_mota= "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noidung = "false";
			@define ( _width_thumb , 230 );
			@define ( _height_thumb , 190 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;

		case 'baiviet':
			$title_main = "Bài viết";
			$config_images = "true";
			$config_mota= "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noidung = "true";
			@define ( _width_thumb , 80 );
			@define ( _height_thumb , 53 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;

			// case 'bottom_sl':
			// $title_main = "Banner";
			// @define ( _width_thumb , 80 );
			// @define ( _height_thumb , 53 );
			// @define ( _style_thumb , 2 );
			// @define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			// $ratio_ = 1;
			// $links_ = "true";
			// $noidung = "true";
			// break;



		case 'hotrokhachhang':
			$title_main = "Hỗ trợ khách hàng";
			$config_images = "true";
			$config_mota= "true";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noidung = "true";
			@define ( _width_thumb , 230 );
			@define ( _height_thumb , 190 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;

		case 'banner':
			$title_main = 'Banner';
			@define ( _width_thumb , 500 );
			@define ( _height_thumb , 120 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'top_footer':
			$title_main = 'Quảng cáo footer';
			@define ( _width_thumb , 845 );
			@define ( _height_thumb , 160 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "false";
			break;

		case 'bgweb':
			$title_main = 'background web';
			@define ( _width_thumb , 500 );
			@define ( _height_thumb , 120 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;
		case 'logo':
			$title_main = 'logo';
			@define ( _width_thumb , 180 );
			@define ( _height_thumb , 50 );
			#@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "false";
			break;

		case 'banner_qc':
			$title_main = 'Banner';
			@define ( _width_thumb , 1200 );
			@define ( _height_thumb , 110 );
			#@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;

		case 'img-thanhtoan':
			$title_main = 'Banner';
			@define ( _width_thumb , 185 );
			@define ( _height_thumb , 85 );
			#@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "false";
			break;

		case 'popup':
			$title_main = 'Banner';
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 720 );
			#@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			$config_hienthi = "true";
			break;

		case 'img-vanchuyen':
			$title_main = 'Banner';
			@define ( _width_thumb , 185 );
			@define ( _height_thumb , 85 );
			#@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "false";
			break;

		case 'img-bocongthuong':
			$title_main = 'Banner';
			@define ( _width_thumb , 120 );
			@define ( _height_thumb , 45 );
			#@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			$hienthi = "true";
			break;
		//-------------photo------------------
		case 'icon_top':
			$title_main = "Hình ảnh Icon Top";
			@define ( _width_thumb , 50 );
			@define ( _height_thumb , 50 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "false";
			break;

			
		case 'slider':
			$title_main = "Hình ảnh slider";
			@define ( _width_thumb , 1200 );
			@define ( _height_thumb , 435 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;	

		case 'banner_sl':
			$title_main = "Banner";
			@define ( _width_thumb , 395 );
			@define ( _height_thumb , 115 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;	

	
			
		case 'doitac':
		    $title_main = "Đối tác";
			@define ( _width_thumb , 175 );
			@define ( _height_thumb , 60 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			$links_ = "true";
			break;
		case 'quangcaongang':
		    $title_main = "Hình ảnh quảng cáo ngang";
			@define ( _width_thumb , 495 );
			@define ( _height_thumb , 160 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;

		case 'quangcaodoc':
		    $title_main = "Hình ảnh quảng cáo hai bên";
			@define ( _width_thumb , 170 );
			@define ( _height_thumb , 440 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;

		case 'facebook':
		    $title_main = "Mạng xã hội";
			@define ( _width_thumb , 16 );
			@define ( _height_thumb , 16 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;
		//--------------defaut---------------
		default: 
			$source = "";
			$template = "index";
			break;
	}

?>