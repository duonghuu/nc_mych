<?php  if(!defined('_source')) die("Error");

		@$idc =  addslashes($_GET['idc']);
		@$idl =  addslashes($_GET['idl']);
		@$idi =  addslashes($_GET['idi']);
		@$ids =  addslashes($_GET['ids']);
		@$id=  addslashes($_GET['id']);
		#các sản phẩm khác======================
		//dump($_GET);
		//print_r($id);



		if($id!=''){

			$d->reset();
			$sql_detail = "select * from #_product where hienthi=1 and type='product' and tenkhongdau='".$id."'";
			$d->query($sql_detail);
			$row_detail = $d->fetch_array();
			daxem($id);

			

			$chuoi = $row_detail['ten_'.$lang];
			//print_r('Tên :'.$chuoi .'<br />');
			$chuoi1 = explode(' ',$chuoi);
			
			$noichuoi = $chuoi1[0].' '.$chuoi1[1];
			//print_r($noichuoi);


			$d->reset();
			$sql_detail = "select * from #_product where hienthi=1 and type='product' and ten_$lang like'%$noichuoi%'  order by stt,ngaytao desc";
			$d->query($sql_detail);
			$product = $d->result_array();
			// /print_r($product);



			//màu sắc
			$d->reset();
			$sql_detail = "select * from #_mausp where id_product='".$row_detail['id']."'";
			$d->query($sql_detail);
			$row_mausp = $d->result_array();

			$d->reset();
			$sql = "select id,thumb,ten_$lang,giaban,tenkhongdau,giacu,dungtich,trongluong,rate,total from #_product where hienthi=1 and type='product' and banchay=1 order by stt,ngaytao desc";
			$d->query($sql);
			$product_banchay = $d->result_array();

			$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />';
			$share_facebook .= '<meta property="og:type" content="website" />';
			$share_facebook .= '<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />';
			$share_facebook .= '<meta property="og:description" content="'.$row_detail['mota_'.$lang].'" />';
			$share_facebook .= '<meta property="og:locale" content="vi" />';
			$share_facebook .= '<meta property="og:image" content="http://'.$config_url.'/'._upload_product_l.$row_detail['photo'].'" />';

			$d->reset();
			$sql = "select * from #_product_photo where hienthi=1 and id_product='".$row_detail["id"]."' and type='product' order by stt,id desc";
			$d->query($sql);
			$hinhanh = $d->result_array();



			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

		} elseif($idl!=''){

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='product' and tenkhongdau='".$idl."'";
			$d->query($sql);
			$row_detail = $d->fetch_array();

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,thumb from #_product_cat where hienthi=1 and type='product' and id_list='".$row_detail['id']."' order by stt,ngaytao desc";
			$d->query($sql);
			$row_item_tt = $d->result_array();

			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_product where hienthi=1 and type='product' and id_list='".$row_detail['id']."'  order by stt,ngaytao desc";

			$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,thongtin_en,dungtich,trongluong,rate,total from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			// $url = getCurrentPageURL();
			// $paging = pagination($where,$per_page,$page,$url);

			$title_detail = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

		} elseif($idc!=''){

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,id_list from #_product_cat where hienthi=1 and type='product' and tenkhongdau='".$idc."'";
			$d->query($sql);
			$row_detail = $d->fetch_array();

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='product' and id='".$row_detail['id_list']."'";
			$d->query($sql);
			$row_detail_list = $d->fetch_array();

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,thumb from #_product_item where hienthi=1 and type='product' and id_cat='".$row_detail['id']."' order by stt,ngaytao desc";
			$d->query($sql);
			$row_item_tt = $d->result_array();

			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_product where hienthi=1 and type='product' and id_cat='".$row_detail['id']."'  order by stt,ngaytao desc";

			$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,thongtin_en,dungtich,trongluong,rate,total from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			// $url = getCurrentPageURL();
			// $paging = pagination($where,$per_page,$page,$url);


			$title_detail = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

		} elseif($idi!=''){

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_item where hienthi=1 and type='product' and tenkhongdau='".$idi."'";
			$d->query($sql);
			$row_detail = $d->fetch_array();

			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_product where hienthi=1 and type='product' and id_item='".$row_detail['id']."'  order by stt,ngaytao desc";

			$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,thongtin_en,dungtich,trongluong,rate,total from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title_detail = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

		} else {
			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;

			if($_GET['thongtin']!=''){
				$thongtin_tk = $_GET['thongtin'];
				if($thongtin_tk=='hang-moi-ve'){

				} elseif($thongtin_tk=='hang-ban-chay'){

					$where_tk  = " and banchay!=0 ";
					
				} elseif($thongtin_tk=='hang-giam-gia'){

					$where_tk  = " and giacu!=0 ";

				} else {
					$where_tk=explode("-",$thongtin_tk);

					$where_tk  = " and giaban>='".$where_tk[0]."' and giaban<='".$where_tk[1]."' ";
				}
			}
			
			$where = " #_product where hienthi=1 and type='product' ";
			$where .= $where_tk;
			$where .= " order by stt,ngaytao desc ";

			$sql = "select ten_$lang,id,thumb,mota_$lang,giacu,giaban,tenkhongdau,gia,size,baohanh_vi,thongtin_vi,thongtin_en,dungtich,trongluong,rate,total from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);


		}
		
		if(!empty($_POST)&&isset($_POST['dangky'])){

		$data['email'] = $_POST['email'];
		$data['tieude'] = $_POST['tieude'];
		$data['ten'] = $_POST['ten'];
		$data['noidung'] = $_POST['noidung'];
		$data['sanpham'] = $_POST['sanpham'];
		$data['ngaytao'] = time();
		$d->setTable('nhanmail');
		if($d->insert($data))
			transfer("Bạn đã đăng ký thành công<br/>Cảm ơn", "san-pham.html");
		else
			transfer("Lưu dữ liệu bị lỗi", "san-pham.html");
		}
		
			
?>